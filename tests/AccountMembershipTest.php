<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AccountMembershipTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAccountCreation()
    {
        $account = factory(App\Account::class)->make();
        $user = factory(App\User::class)->make();
        $account->save();
        $user->save();

        $membership = new App\Membership;
        $membership->account_id = $account->id;
        $membership->user_id = $user->id;
        $membership->role = 'owner';
        $membership->save();

        $this->asserEquals($membership->account_id, $account->id);

        $this->asserEquals(count($user->memberships), 1);

    }

    public function testGetAccountsForUser()
    {
        $account = App\Account::where('subdomain', 'pulsar')->first();

        $user = $account->owner();

        Auth::login($user);

    }
}
