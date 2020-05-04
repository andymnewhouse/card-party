<?php

use Illuminate\Database\Seeder;
use Spatie\Mailcoach\Models\EmailList;

class MailCoachSeeder extends Seeder
{
    public function run()
    {
        $emailList = EmailList::create(['name' => 'Newsletter']);

        $emailList->subscribeSkippingConfirmation('hi@andymnewhouse.me');
        $emailList->subscribeSkippingConfirmation('beccaswick26@gmail.com');
        $emailList->subscribeSkippingConfirmation('pswick62@gmail.com');
        $emailList->subscribeSkippingConfirmation('drsswick@gmail.com');
        $emailList->subscribeSkippingConfirmation('jessnewhouse24@gmail.com');
    }
}
