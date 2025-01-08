<?php

namespace App\Repositories\Admin;

use App\Models\Admin\FacilityExpense;
use App\Models\Admin\FacilityService;
use App\Models\FacilityAccess;
use App\Models\User;
use App\Models\UserSubscriptionPackage;
use App\Repositories\BaseRepository;
use Illuminate\Database\Query\JoinClause;

class BusinessOverviewRepository extends BaseRepository
{
    /**
     * Create a new repository instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * @param $from
     * @param $to
     * @param $facilityId
     * @param  bool  $subscribed
     * @param  bool  $anonymous
     * @return int|mixed
     */
    public function getTotalIncome($from, $to, $facilityId = null, bool $subscribed = false, bool $anonymous = false)
    {
        $builder = FacilityAccess::query();

        $facilityAccessesTable = (new FacilityAccess())->getTable();
        $facilityServicesTable = (new FacilityService())->getTable();

        $builder->select('facility_accesses.*')
            ->join(
                $facilityServicesTable,
                function (JoinClause $join) use ($facilityAccessesTable, $facilityServicesTable) {
                    return $join->on(
                        sprintf('%s.service_id', $facilityAccessesTable),
                        '=',
                        sprintf('%s.id', $facilityServicesTable)
                    );
                }
            )
            ->whereDate('facility_accesses.created_at', '>=', $from)
            ->whereDate('facility_accesses.created_at', '<=', $to)
            ->where('facility_accesses.user_type', '!=', 'package_user');

        if ($facilityId) {
            $builder->where('facility_id', $facilityId);
        }

        if ($subscribed) {
            $builder->where('is_subscribed', true);
        }

        if ($anonymous) {
            $builder->where('is_subscribed', false);
        }

        return ['total_income' => $builder->sum('facility_accesses.price')];
    }

    /**
     * @param $from
     * @param $to
     * @param $facilityId
     * @return int|mixed
     */
    public function getTotalExpense($from, $to, $facilityId = null)
    {
        $builder = FacilityExpense::query();

        $builder->whereDate('created_at', '>=', $from)
            ->whereDate('created_at', '<=', $to);

        if ($facilityId) {
            $builder->where('facility_id', $facilityId);
        }

        return ['total_expense' => $builder->sum('amount')];
    }

    /**
     * @param $from
     * @param $to
     * @return array
     */
    public function getBusinessOverviewData($from, $to)
    {
//        $data['total_income'] = $this->getTotalIncome($from, $to);
        $totalIncomeSubscribed = $this->getTotalIncome($from, $to, null, true);
        $totalIncomeAnon = $this->getTotalIncome($from, $to, null, false, true);
        $totalExpense = $this->getTotalExpense($from, $to);

        $data['total_income_subscribed'] = $totalIncomeSubscribed['total_income'];
        $data['total_income_anonymous'] = $totalIncomeAnon['total_income'];
        $data['total_income'] = $data['total_income_anonymous'] + $data['total_income_subscribed'];
        $data['total_expense'] = $totalExpense['total_expense'];
        $data['total_profit'] = $data['total_income'] - $data['total_expense'];
        $data['total_new_users'] = $this->getTotalUsers($from, $to);
        $data['total_new_users_male'] = $this->getTotalUsers($from, $to, 'male');
        $data['total_new_users_female'] = $this->getTotalUsers($from, $to, 'female');
        $data['total_new_users_other'] = $this->getTotalUsers($from, $to, 'other');
        $data['total_usages_male'] = $this->getTotalUsages($from, $to, 'male');
        $data['total_usages_female'] = $this->getTotalUsages($from, $to, 'female');

        return $data;
    }

    /**
     * @param $from
     * @param $to
     * @param $gender
     * @return int
     */
    public function getTotalUsers($from, $to, $gender = null)
    {
        $builder = User::query();

        $builder->whereDate('created_at', '>=', $from)
            ->whereDate('created_at', '<=', $to)
            ->where('free_access', false);

        if ($gender) {
            $builder->where('gender', '=', $gender);
        }

        return $builder->count();
    }

    /**
     * @param $from
     * @param $to
     * @param $gender
     * @return int
     */
    public function getTotalUsages($from, $to, $gender = null, $facilityId = null)
    {
        $builder = FacilityAccess::query();

        $builder->whereDate('created_at', '>=', $from)
            ->whereDate('created_at', '<=', $to);

        if ($gender) {
            $builder->where('gender', '=', $gender);
        }

        if ($facilityId) {
            $facilityServices = FacilityService::where('facility_id', $facilityId)->get()->pluck('id')->toArray();

            $builder->whereIn('service_id', $facilityServices);
        }

        return $builder->count();
    }

    /**
     * @param $from
     * @param $to
     * @return array
     */
    public function getSubPackagesIncome($from, $to, $facilityId = null)
    {
        $builder = UserSubscriptionPackage::query();

        $builder->with('subscriptionPackage')
            ->whereDate('created_at', '>=', $from)
            ->whereDate('created_at', '<=', $to);

        if ($facilityId) {
            $builder->where('facility_id', $facilityId);
        }

        $userSubPackages = $builder->get();

        $totalAmount = $userSubPackages->sum(function ($userSubPackage) {
            return $userSubPackage->subscriptionPackage->amount;
        });

        return ['total_income_subscriptions' => $totalAmount];
    }
}
