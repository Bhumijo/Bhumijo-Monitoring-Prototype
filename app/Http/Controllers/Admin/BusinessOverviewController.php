<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\BusinessOverviewRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BusinessOverviewController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(private BusinessOverviewRepository $businessOverviewRepository)
    {
        //
    }

    /**
     * @OA\Get(
     *      tags={"Admin Business Overview"},
     *      path="/api/admin/business-overview/total-income",
     *      summary="Display total income",
     *      security={
     *         {
     *             "bearerAuth": {}
     *         }
     *      },
     *      @OA\Parameter(
     *          name="facility_id",
     *          in="query",
     *          description="filter by facility id",
     *          required=false,
     *          @OA\Schema(
     *              type="number", example="1"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="from",
     *          in="query",
     *          description="from date range in YYYY-MM-DD format",
     *          required=false,
     *          @OA\Schema(
     *              type="string", example="2022-05-30"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="to",
     *          in="query",
     *          description="to date range in YYYY-MM-DD format",
     *          required=false,
     *          @OA\Schema(
     *              type="string", example="2022-06-15"
     *          )
     *      ),
     *      @OA\Response(
     *         response=200,
     *         description="Successful",
     *          @OA\JsonContent(
     *              @OA\Property(property="total_income", type="number",example="150"),
     *              @OA\Property(property="total_income_subscribed", type="number",example="150"),
     *              @OA\Property(property="total_income_anonymous", type="number",example="150"),
     *          )
     *     )
     * )
     *
     * Get total income
     */
    public function totalIncome(Request $request)
    {
        $from = $request->get('from', Carbon::now()->subDay(6)->startOfDay());
        $to = $request->get('to', Carbon::now()->endOfDay());
        $facilityId = $request->get('facility_id', null);

        $income = $this->businessOverviewRepository->getTotalIncome($from, $to, $facilityId);
        $totalIncomeSubscribed = $this->businessOverviewRepository->getTotalIncome($from, $to, $facilityId, true);
        $totalIncomeAnon = $this->businessOverviewRepository->getTotalIncome($from, $to, $facilityId, false, true);

        return [
            'total_income' => $income['total_income'],
            'total_income_subscribed' => $totalIncomeSubscribed['total_income'],
            'total_income_anon' => $totalIncomeAnon['total_income'],
        ];
    }

    /**
     * @OA\Get(
     *      tags={"Admin Business Overview"},
     *      path="/api/admin/business-overview/total-expense",
     *      summary="Display total expense",
     *      security={
     *         {
     *             "bearerAuth": {}
     *         }
     *      },
     *      @OA\Parameter(
     *          name="facility_id",
     *          in="query",
     *          description="filter by facility id",
     *          required=false,
     *          @OA\Schema(
     *              type="number", example="1"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="from",
     *          in="query",
     *          description="from date range in YYYY-MM-DD format",
     *          required=false,
     *          @OA\Schema(
     *              type="string", example="2022-05-30"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="to",
     *          in="query",
     *          description="to date range in YYYY-MM-DD format",
     *          required=false,
     *          @OA\Schema(
     *              type="string", example="2022-06-15"
     *          )
     *      ),
     *      @OA\Response(
     *         response=200,
     *         description="Successful",
     *          @OA\JsonContent(
     *              @OA\Property(property="total_expense", type="number",example="150"),
     *          )
     *     )
     * )
     *
     * Get total expense
     */
    public function totalExpense(Request $request)
    {
        $from = $request->get('from', Carbon::now()->subDay(6)->startOfDay());
        $to = $request->get('to', Carbon::now()->endOfDay());
        $facilityId = $request->get('facility_id', null);

        return $this->businessOverviewRepository->getTotalExpense($from, $to, $facilityId);
    }

    /**
     * @OA\Get(
     *      tags={"Admin Business Overview"},
     *      path="/api/admin/business-overview",
     *      summary="Display business overview",
     *      security={
     *         {
     *             "bearerAuth": {}
     *         }
     *      },
     *      @OA\Parameter(
     *          name="from",
     *          in="query",
     *          description="from date range in YYYY-MM-DD format",
     *          required=false,
     *          @OA\Schema(
     *              type="string", example="2022-05-30"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="to",
     *          in="query",
     *          description="to date range in YYYY-MM-DD format",
     *          required=false,
     *          @OA\Schema(
     *              type="string", example="2022-06-15"
     *          )
     *      ),
     *      @OA\Response(
     *         response=200,
     *         description="Successful",
     *          @OA\JsonContent(
     *              @OA\Property(property="total_income", type="number",example="150"),
     *              @OA\Property(property="total_income_subscribed", type="number",example="50"),
     *              @OA\Property(property="total_income_anonymous", type="number",example="100"),
     *              @OA\Property(property="total_expense", type="number",example="500"),
     *              @OA\Property(property="total_profit", type="number",example="-350"),
     *              @OA\Property(property="total_new_users", type="number",example="150"),
     *              @OA\Property(property="total_new_users_male", type="number",example="50"),
     *              @OA\Property(property="total_new_users_female", type="number",example="100"),
     *              @OA\Property(property="total_new_users_other", type="number",example="100"),
     *              @OA\Property(property="total_usages_male", type="number",example="100"),
     *              @OA\Property(property="total_usages_female", type="number",example="100"),
     *          )
     *     )
     * )
     *
     * Get overview of the business
     */
    public function businessOverview(Request $request)
    {
        $from = $request->get('from', Carbon::now()->subDay(6)->startOfDay());
        $to = $request->get('to', Carbon::now()->endOfDay());

        return $this->businessOverviewRepository->getBusinessOverviewData($from, $to);
    }

    /**
     * @OA\Get(
     *      tags={"Admin Business Overview"},
     *      path="/api/admin/business-overview/total-usages",
     *      summary="Display total usages",
     *      security={
     *         {
     *             "bearerAuth": {}
     *         }
     *      },
     *      @OA\Parameter(
     *          name="facility_id",
     *          in="query",
     *          description="filter by facility id",
     *          required=false,
     *          @OA\Schema(
     *              type="number", example="1"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="from",
     *          in="query",
     *          description="from date range in YYYY-MM-DD format",
     *          required=false,
     *          @OA\Schema(
     *              type="string", example="2022-05-30"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="to",
     *          in="query",
     *          description="to date range in YYYY-MM-DD format",
     *          required=false,
     *          @OA\Schema(
     *              type="string", example="2022-06-15"
     *          )
     *      ),
     *      @OA\Response(
     *         response=200,
     *         description="Successful",
     *          @OA\JsonContent(
     *              @OA\Property(property="total_usage_male", type="number",example="150"),
     *              @OA\Property(property="total_usage_female", type="number",example="150"),
     *          )
     *     )
     * )
     *
     * Get total expense
     */
    public function totalUsage(Request $request)
    {
        $from = $request->get('from', Carbon::now()->subDay(6)->startOfDay());
        $to = $request->get('to', Carbon::now()->endOfDay());
        $facilityId = $request->get('facility_id', null);

        $totalMaleUsage = $this->businessOverviewRepository->getTotalUsages($from, $to, 'male', $facilityId);
        $totalFemaleUsage = $this->businessOverviewRepository->getTotalUsages($from, $to, 'female', $facilityId);

        return [
            'total_usage_male' => $totalMaleUsage,
            'total_usage_female' => $totalFemaleUsage,
        ];
    }

    /**
     * @OA\Get(
     *      tags={"Admin Business Overview"},
     *      path="/api/admin/subscription-packages/income",
     *      summary="Display total income from subscription packages",
     *      security={
     *         {
     *             "bearerAuth": {}
     *         }
     *      },
     *      @OA\Parameter(
     *          name="from",
     *          in="query",
     *          description="from date range in YYYY-MM-DD format",
     *          required=false,
     *          @OA\Schema(
     *              type="string", example="2022-05-30"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="to",
     *          in="query",
     *          description="to date range in YYYY-MM-DD format",
     *          required=false,
     *          @OA\Schema(
     *              type="string", example="2022-06-15"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="facility_id",
     *          in="query",
     *          description="filter by facility id",
     *          required=false,
     *          @OA\Schema(
     *              type="number", example="1"
     *          )
     *      ),
     *      @OA\Response(
     *         response=200,
     *         description="Successful",
     *          @OA\JsonContent(
     *              @OA\Property(property="total_income_subscriptions", type="number",example="150")
     *          )
     *     )
     * )
     *
     * Get total subscription pacakges income
     */
    public function subscriptionPackagesData(Request $request)
    {
        $from = $request->get('from', Carbon::now()->subDay(6)->startOfDay());
        $to = $request->get('to', Carbon::now()->endOfDay());
        $facilityId = $request->get('facility_id', null);

        return $this->businessOverviewRepository->getSubPackagesIncome($from, $to, $facilityId);
    }
}
