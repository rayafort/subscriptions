<?php

declare(strict_types=1);

namespace RayaFort\Subscriptions\Traits;

use RayaFort\Subscriptions\Models\Plan;
use RayaFort\Subscriptions\Services\Period;
use Illuminate\Database\Eloquent\Collection;
use RayaFort\Subscriptions\Models\PlanSubscription;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasSubscriptions
{
    /**
     * Define a polymorphic one-to-many relationship.
     *
     * @param string $related
     * @param string $name
     * @param string $type
     * @param string $id
     * @param string $localKey
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    abstract public function morphMany($related, $name, $type = null, $id = null, $localKey = null);

    /**
     * The user may have many subscriptions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function subscriptions(): MorphMany
    {
        return $this->morphMany(config('rayafort.subscriptions.models.plan_subscription'), 'user');
    }

    /**
     * A model may have many active subscriptions.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function activeSubscriptions(): Collection
    {
        return $this->subscriptions->reject->inactive();
    }

	/**
	 * Get a subscription by name.
	 *
	 * @param string $subscriptionName
	 *
	 * @param string $language
	 *
	 * @return \RayaFort\Subscriptions\Models\PlanSubscription|null
	 */
    public function subscription(string $subscriptionName, $language = 'en'): ?PlanSubscription
    {
        return $this->subscriptions()->where("name->{$language}", $subscriptionName)->first();
    }

    /**
     * Get subscribed plans.
     *
     * @return \RayaFort\Subscriptions\Models\PlanSubscription|null
     */
    public function subscribedPlans(): ?PlanSubscription
    {
        $planIds = $this->subscriptions->reject->inactive()->pluck('plan_id')->unique();

        return app('rayafort.subscriptions.plan')->whereIn('id', $planIds)->get();
    }

    /**
     * Check if the user subscribed to the given plan.
     *
     * @param int $planId
     *
     * @return bool
     */
    public function subscribedTo($planId): bool
    {
        $subscription = $this->subscriptions()->where('plan_id', $planId)->first();

        return $subscription && $subscription->active();
    }

    /**
     * Subscribe user to a new plan.
     *
     * @param string                            $subscription
     * @param \RayaFort\Subscriptions\Models\Plan $plan
     *
     * @return \RayaFort\Subscriptions\Models\PlanSubscription
     */
    public function newSubscription($subscription, Plan $plan): PlanSubscription
    {
        $trial = new Period($plan->trial_interval, $plan->trial_period, now());
        $period = new Period($plan->invoice_interval, $plan->invoice_period, $trial->getEndDate());

        return $this->subscriptions()->create([
            'name' => $subscription,
            'plan_id' => $plan->getKey(),
            'trial_ends_at' => $trial->getEndDate(),
            'starts_at' => $period->getStartDate(),
            'ends_at' => $period->getEndDate(),
        ]);
    }
}
