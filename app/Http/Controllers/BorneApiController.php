<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpFoundation\Response;

class BorneApiController extends Controller
{
    private const DEFAULT_INTERVAL = 30;

    public function index(Request $request)
    {
        try {
            $interval = $this->getIntervalFromRequest($request);
            $borneNumber = $this->getBorneNumberFromRequest($request);

            $rawQuery = sprintf(
                "AVG(power) as power, sec_to_time(time_to_sec(timestamp) - time_to_sec(timestamp) %% (%d)) as time,date_format(timestamp, '%%Y-%%m-%%d') as date", $interval
            );

            $query = DB::table('bornes')
                ->selectRaw($rawQuery);

            if ($borneNumber !== null) {
                $query->where('num_borne', '=', $borneNumber);
            }

            return response()->json($query->groupBy('time', 'date')->get());
        } catch (BadRequestHttpException $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
                'code' => Response::HTTP_BAD_REQUEST,
            ], Response::HTTP_BAD_REQUEST);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'An internal server error occured. Please try again later',
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    private function getIntervalFromRequest(Request $request): int
    {
        $interval = $request->query('interval');
        if ($interval === null || strlen($interval) === 0) {
            return self::DEFAULT_INTERVAL;
        }

        $options = [
            'options' => [
                'min_range' => self::DEFAULT_INTERVAL,
            ],
        ];

        $interval = filter_var(
            $interval,
            FILTER_VALIDATE_INT,
            $options
        );

        if ($interval === false) {
            throw new BadRequestHttpException('Please provide a valid interval (integer)');
        }

        return $interval;
    }

    private function getBorneNumberFromRequest(Request $request): ?int
    {
        $borneNumber = $request->id;
        if ($borneNumber === null) {
            return null;
        }

        $borneNumber = filter_var($borneNumber, FILTER_VALIDATE_INT);
        if ($borneNumber === false) {
            throw new BadRequestHttpException('Please provide a valid borneNumber (integer)');
        }

        return $borneNumber;
    }
}
