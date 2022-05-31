<?php

namespace App\Http\Controllers;

use App\Models\Coaching;
use App\Models\Offer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent;
use Illuminate\Support\Facades\DB;

class OfferController extends Controller
{
    public function index()
    {
        return Offer::with(['coachings', 'user'])->get();
    }


    // ----------------- get ------------------------
    public function getAllCoachings()
    {
        return Coaching::with(['offer', 'user'])->get();
    }


    // find offer by a given offer id
    public function findById(int $id)
    {
        $offer = Offer::where('id', $id)->with(['coachings', 'user'])->first();
        return $offer != null ? response()->json($offer, 200) : response()->json(null, 200);
    }

    // check if an offer with an id already exists
    public function checkID(int $id)
    {
        $offer = Offer::where('id', $id)->first();
        return $offer != null ? response()->json(true, 200) : response()->json(false, 200);
    }


    // get all offers from a tutor id
    public function findTutor(int $tutor_id)
    {
        $offers = Offer::where('user_id', $tutor_id)->with(['coachings', 'user'])->first();;
        return $offers != null ? response()->json($offers, 200) : response()->json(null, 200);
    }

    // get all coachings from a user
    public function getOwnCoachings(int $user_id)
    {
        $coachings = Coaching::where('user_id', $user_id)->with(['user', 'offer'])->get();
        return $coachings != null ? response()->json($coachings, 200) : response()->json(null, 200);
    }


    // ----------------- post ------------------------
    // create new offer
    public function save(Request $request): JsonResponse
    {
        $request = $this->parseRequest($request);
        // use a transaction for saving model including relations
        DB::beginTransaction();
        try {
            // offer anlegen
            $offer = Offer::create($request->all());
            DB::commit();
            return response()->json($offer, 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json("saving offer failed: " . $e->getMessage(), 420);
        }
    }


    private function parseRequest(Request $request)
    {
        // get data and convert is - ISO 8601, zB "2022-03-11T14:52:11.00Z"
        $date = new \DateTime($request->date);
        $start = new \DateTime($request->start);
        $end = new \DateTime($request->end);
        $request['date'] = $date;
        $request['start'] = $start;
        $request['end'] = $end;
        return $request;
    }


    // ----------------- put ------------------------
    // update an offer
    public function update(Request $request, string $id): JsonResponse
    {
        DB::beginTransaction();
        try {
            $offer = Offer::with(['user'])
                ->where('id', $id)->first();
            if ($offer != null) {
                $request = $this->parseRequest($request);
                $offer->update($request->all());
                $offer->save();
            }
            DB::commit();
            $offer1 = Offer::with(['user'])
                ->where('id', $id)->first();
            // return a vaild http response
            return response()->json($offer1, 201);
        } catch (\Exception $e) {
            // rollback all queries
            DB::rollBack();
            return response()->json("updating offer failed: " . $e->getMessage(), 420);
        }
    }

    // save comment to offer with id
    public function saveComment(Request $request, string $id): JsonResponse
    {
        DB::beginTransaction();
        try {
            $offer = Offer::with(['user'])
                ->where('id', $id)->first();
            if ($offer != null) {
                $offer->update($request->all());
                $offer->save();
            }
            DB::commit();
            $offer1 = Offer::with(['user'])
                ->where('id', $id)->first();
            // return a vaild http response
            return response()->json($offer1, 201);
        } catch (\Exception $e) {
            // rollback all queries
            DB::rollBack();
            return response()->json("updating offer failed: " . $e->getMessage(), 420);
        }
    }

    // book offer and create new coaching entry
    public function bookOffer(Request $request, string $id): JsonResponse
    {
        DB::beginTransaction();
        try {
            $offer = Offer::with(['user'])
                ->where('id', $id)->first();
            if ($offer != null) {
                $offer->update($request->all());

                // save coaching
                // if (isset($request['coachings'])) {
                if (isset($offer->bookedUser)) {
                    $newCoaching = Coaching::firstOrNew(['user_id' => $offer->bookedUser, 'offer_id' => $offer->id]);
                    $offer->coachings()->save($newCoaching);
                }
                $offer->save();
            }
            DB::commit();
            $offer1 = Offer::with(['user'])
                ->where('id', $id)->first();
            // return a vaild http response
            return response()->json($offer1, 201);
        } catch (\Exception $e) {
            // rollback all queries
            DB::rollBack();
            return response()->json("updating offer failed: " . $e->getMessage(), 420);
        }
    }


    // ----------------- delete ------------------------
    public function delete(string $id): JsonResponse
    {
        $offer = Offer::where('id', $id)->first();
        if ($offer != null) {
            $offer->delete();
        } else {
            throw new \Exception("offer could not be deleted - it does not exist!");
        }
        return response()->json('offer (' . $id . ') successfully deleted', 200);
    }

}
