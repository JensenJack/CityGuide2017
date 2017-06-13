<?php

namespace Modules\Email\Database\Seeders;

use Carbon\Carbon as Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use DB;

class EmailDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Model::unguard();

        // $this->call("OthersTableSeeder");
         $permission_model = config('access.permission');
        $view_email = new $permission_model();
        $view_email->name = 'view-email';
        $view_email->display_name = 'View Email';
        $view_email->sort = 5;
        $view_email->created_at = Carbon::now();
        $view_email->updated_at = Carbon::now();
        $view_email->save(); 
        
        $permission_model = config('access.permission');
        $create_email = new $permission_model();
        $create_email->name = 'create-email';
        $create_email->display_name = 'Create Email';
        $create_email->sort = 5;
        $create_email->created_at = Carbon::now();
        $create_email->updated_at = Carbon::now();
        $create_email->save();

        $permission_model = config('access.permission');
        $delete_email = new $permission_model();
        $delete_email->name = 'delete-email';
        $delete_email->display_name = 'Delete Email';
        $delete_email->sort = 5;
        $delete_email->created_at = Carbon::now();
        $delete_email->updated_at = Carbon::now();
        $delete_email->save();

        $permission_model = config('access.permission');
        $edit_email = new $permission_model();
        $edit_email->name = 'edit-email';
        $edit_email->display_name = 'Edit Email';
        $edit_email->sort = 5;
        $edit_email->created_at = Carbon::now();
        $edit_email->updated_at = Carbon::now();
        $edit_email->save();


            $email = array(
  array('id' => '1','slug' => 'member_register','subject' => 'BNF Express  - Activate Your Account   ','content' => '<p>Hello {USERNAME}</p>

<p>{NEWLINE}</p>

<p>Please activate your account using the following link.</p>

<p>{NEWLINE} ---------------------------------------------- {NEWLINE}</p>

<p>{LINK}</p>

<p>---------------------------------------------- {NEWLINE}</p>

<p>Thanks and Best regards,</p>

<p>Book Myanmar Hotel HR Operations Team</p>
','mm_subject' => 'Book Myanmar Hotel - Activate Your Account   ','mm_content' => '<p>Hello {USERNAME}</p>

<p>{NEWLINE}</p>

<p>Please activate your account using the following link.</p>

<p>{NEWLINE} ---------------------------------------------- {NEWLINE}</p>

<p>{LINK}</p>

<p>---------------------------------------------- {NEWLINE}</p>

<p>Thanks and Best regards,</p>

<p>Book Myanmar Hotel HR Operations Team</p>
','ledgen'=>'{USERNAME},{NEWLINE},{LINK,}','created_at' => '2015-06-14 01:36:23','updated_at' => '2015-06-14 02:04:56'),

  array('id' => '2','slug' => 'member_forgot_password','subject' => 'Book Myanmar Hotel - Click the on link and copy your New Password','content' => 'Hello {NAME} ,

You have request&nbsp; a new password for your Book Myanmar Hotel Account.

Please login with your new password using the following link.

{LINK}

<span>New password: {PASSWORD}<br>
&nbsp;</span>

&nbsp;

With Regards,

Administrator.','mm_subject' => 'Book Myanmar Hotel - Click the on link and copy your New Password','mm_content' => 'Hello {NAME} ,

You have request&nbsp; a new password for your Book Myanmar Hotel Account.

Please login with your new password using the following link.

{LINK}

<span>New password: {PASSWORD}<br>
&nbsp;</span>

&nbsp;

With Regards,

Administrator.','ledgen'=>'{NAME},{LINK},{PASSWORD}','created_at' => '2015-06-14 01:36:23','updated_at' => '2016-12-27 07:51:21'),
  array('id' => '3','slug' => 'admin_forgot_password','subject' => 'This is admin new password.','content' => 'Your admin password has been reset in Book Myanmar Hotel.

UserName : {USERNAME}

Your new password is : {PASSWORD}

Please Login in here {LINK}

With Regards,

Administrator.','mm_subject' => 'This is admin new password.','mm_content' => 'Your admin password has been reset in Book Myanmar Hotel.

UserName : {USERNAME}

Your new password is : {PASSWORD}

Please Login in here {LINK}

With Regards,

Administrator.','ledgen'=>'{USERNAME},{PASSWORD},{LINK}','created_at' => '2015-06-20 18:50:39','updated_at' => '2016-12-27 07:52:01'),
  array('id' => '5','slug' => 'booking','subject' => 'Ticket From Book Myanmar Hotel','content' => 'Hi {NAME},

We\'ve send the ticket from Book Myanmar Hotel Ticket that you have ordered.

Please check the following Ticket Attachment.','mm_subject' => 'Ticket From Book Myanmar Hotel','mm_content' => 'Hi {NAME},

We\'ve send the ticket from Book Myanmar Hotel Ticket that you have ordered.

Please check the following Ticket Attachment.','ledgen'=>'{NAME}','created_at' => '2015-06-20 18:50:39','updated_at' => '2016-12-26 15:31:24'),
  array('id' => '6','slug' => 'member_booking','subject' => 'Book Myanmar Hotel Booking Reference Confirmation.','content' => 'Dear {NAME},

Thanks for the booking with us. Our operation is working for you now and Agent will contact to you soon.

Your Booking Reference Number is {REF_ID}

<span>You can make ticket tracking <a href="http://bnfexpress.com" target="" rel="">Here</a>.</span>

&nbsp;

Should you require further information or assistance . Please feel free to contact us at ticket@green-myanmar.com.

&nbsp;

Thanks and Best regards, Book Myanmar Hotel Ticket Team

&nbsp;

This is auto generated email. Please do not reply email to this email.','mm_subject' => 'Book Myanmar Hotel Booking Reference Confirmation.','mm_content' => 'Dear {NAME},

Thanks for the booking with us. Our operation is working for you now and Agent will contact to you soon.

Your Booking Reference Number is {REF_ID}

<span>You can make ticket tracking <a href="http://bnfexpress.com" target="" rel="">Here</a>.</span>

&nbsp;

Should you require further information or assistance . Please feel free to contact us at ticket@green-myanmar.com.

&nbsp;

Thanks and Best regards, Book Myanmar Hotel Ticket Team

&nbsp;

This is auto generated email. Please do not reply email to this email.','ledgen'=>'{NAME},{REF_ID}','created_at' => '2015-06-20 18:50:39','updated_at' => '2016-12-27 07:53:20'),
  array('id' => '7','slug' => 'initial_booking','subject' => 'This is not ticket - Initial details (bookmyanmarhotels.com)','content' => '<table align="left" border="0" cellpadding="1" cellspacing="1" style="width:100%">
    <tbody>
        <tr>
            <td colspan="2">
            <p>Dear {NAME},</p>

            <p>This is to confirm that we have received the payment for the following booking. We will now go ahead and reserve in order to secure the booking.</p>

            <p>In the mean time, if you should require anything, you can reach us on +95 (9) 428016234, +95 (1) 569936 or email us ticket@green-myanmar.com.</p>

            <p>Did you know that you can always see the booking status and download the E-ticket when it is ready. All you have to do is type in the Ticket Number&nbsp;{REF_ID} in the Track ticket status field on top right cornor of every page on our website.</p>
            </td>
        </tr>
        <tr>
            <td>
            <p>Client Name&nbsp;&nbsp;&nbsp; :&nbsp;&nbsp; {NAME}</p>

            <p>Ticket Number:&nbsp;&nbsp;&nbsp; {REF_ID}</p>

        </td></tr>
        <tr>
            <td colspan="2">
            <p>Status&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp; <strong>Awaiting enabled room. Please wait for Complete E-ticket in our next mail.</strong></p>

            <p>Remark: You must have room number which we will send you with Complete E-ticket next. Due to strict policy with Hotels, we can only obtain room number 7 days in advance before travel date as earliest.</p>
            </td>
        </tr>
        <tr>
            <td colspan="2">
            <table border="1" cellpadding="0" cellspacing="0" style="height:168px; width:652px">
                <tbody>
                    <tr>
                        <td>
                        <p align="center"><strong>Check In Date</strong></p>
                        </td>
                        <td>
                        <p align="center"><strong>Check Out Date</strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <p align="center">{C_I_TIME}</p>
                        </td>
                        <td>
                        <p align="center">{C_O_TIME}</p>
                        </td>
                    </tr>
                </tbody>
            </table>
            </td>
        </tr>
        <tr>
            <td colspan="2">
            <p><em>The booking is non-refundable and can\'t be exchanged. For more information and FAQ, please visit our website at www.</em>bookmyanmarhotels<em>.com. Terms &amp; Condition can also be found on our website. Thank you for choosing us. </em></p>
            </td>
        </tr>
    </tbody>
</table>
','mm_subject' => 'This is not ticket - Initial details (bookmyanmarhotels.com)','mm_content' => '<table align="left" border="0" cellpadding="1" cellspacing="1" style="width:100%">
    <tbody>
        <tr>
            <td colspan="2">
            <p>Dear {NAME},</p>

            <p>This is to confirm that we have received the payment for the following route. We will now go ahead and reserve in order to secure the seat.</p>

            <p>In the mean time, if you should require anything, you can reach us on +95 (9) 428016234, +95 (1) 569936 or email us ticket@green-myanmar.com.</p>

            <p>Did you know that you can always see the booking status and download the E-ticket when it is ready. All you have to do is type in the Ticket Number&nbsp;{REF_ID} in the Track ticket status field on top right cornor of every page on our website.</p>
            </td>
        </tr>
        <tr>
            <td>
            <p>Client Name&nbsp;&nbsp;&nbsp; :&nbsp;&nbsp; {NAME}</p>

            <p>Ticket Number:&nbsp;&nbsp;&nbsp; {REF_ID}</p>

        </td></tr>
        <tr>
            <td colspan="2">
            <p>Status&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp; <strong>Awaiting seat number. Please wait for Complete E-ticket in our next mail.</strong></p>

            <p>Remark: You must have seat number to take the bus which we will send you with Complete E-ticket next. Due to strict policy with Hotels, we can only obtain room number 7 days in advance before travel date as earliest.</p>
            </td>
        </tr>
        <tr>
            <td colspan="2">
            <table border="1" cellpadding="0" cellspacing="0" style="height:168px; width:652px">
                <tbody>
                    <tr>
                        <td>
                        <p><strong>Check In Date</strong></p>
                        </td>
                        <td>
                        <p><strong>Check Out Date</strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <p>{C_I_TIME}</p>
                        </td>
                        <td>
                        <p>{C_O_TIME}</p>
                        </td>
                    </tr>
                </tbody>
            </table>
            </td>
        </tr>
        <tr>
            <td colspan="2">
            <p><em>The booking is non-refundable and can\'t be exchanged. For more information and FAQ, please visit our website at www.</em>bookmyanmarhotels<em>.com. Terms &amp; Condition can also be found on our website. Thank you for choosing us. </em></p>
            </td>
        </tr>
    </tbody>
</table>
','ledgen'=>'{NAME},{REF_ID},{BASE_URL},{C_I_TIME},{C_O_TIME}','created_at' => '2015-06-20 18:50:39','updated_at' => '2016-08-11 00:44:37'),
  array('id' => '8','slug' => 'final_booking','subject' => 'Book Myanmar Hotel - Complete E-ticket','content' => 'Dear {NAME},

&nbsp;

&nbsp;

Please find the attached E-ticket for booking {REF_ID}, for you to bring along. It is required&nbsp; to present the E-ticket at the gate as you board the bus.

If you should require anything, you can reach us on +95 (9) 428016234, +95 (1) 569936 or email us ticket@green-myanmar.com.

If you should have any problem to download or see our Complete E-Ticket, you can always download the E-ticket when it is ready. All you have to do is type in the Ticket Number&nbsp;{REF_ID} in the Track ticket status field on top right corner of every page on our website.

We thank you for choosing us and hope to serve you again in the near future.

Have a pleasant journey.&nbsp;

Thanks and Best regards, Book Myanmar Hotel Ticket Operations Team','mm_subject' => 'Book Myanmar Hotel - Complete E-ticket','mm_content' => 'Dear {NAME},

&nbsp;

&nbsp;

Please find the attached E-ticket for booking {REF_ID}, for you to bring along. It is required&nbsp; to present the E-ticket at the gate as you board the bus.

If you should require anything, you can reach us on +95 (9) 428016234, +95 (1) 569936 or email us ticket@green-myanmar.com.

If you should have any problem to download or see our Complete E-Ticket, you can always download the E-ticket when it is ready. All you have to do is type in the Ticket Number&nbsp;{REF_ID} in the Track ticket status field on top right corner of every page on our website.

We thank you for choosing us and hope to serve you again in the near future.

Have a pleasant journey.&nbsp;

Thanks and Best regards,

Book Myanmar Hotel Ticket Operations Team','ledgen'=>'{REF_ID},{NAME}','created_at' => '2015-06-20 18:50:39','updated_at' => '2016-12-26 15:25:13'),
  array('id' => '9','slug' => 'cancel_booking','subject' => 'Book Myanmar Hotel Ticket booking cancellation ','content' => '<p>Dear {NAME},</p>

<p>We would like to inform you that your booking ref: {REF_ID} has been cancelled. Necessary refund or exchange has been made as agreed.</p>

<p><em>In some case, we had to cancel the old ticket due to some information changes on the issue ticket. Since our system do not allow us to change any information on the issued ticket, we have to cancel old ticket and re-issue New Ticket No. which will be found at the bottom of this mail. </em></p>

<p>If you should have any question or require anything, please do not hesitate to contact us on +95 (9) 428016234, +95 (1) 569936 or email us ticket@green-myanmar.com.</p>

<p>We hope to serve you again in the future.</p>

<p>{C_REMARK}</p>

<p>&nbsp;</p>

<p>Thanks and Best regards,</p>

<p>Book Myanmar Hotel Ticket Operations Team</p>
','mm_subject' => 'Book Myanmar Hotel Ticket booking cancellation ','mm_content' => '<p>Dear {NAME},</p>

<p>We would like to inform you that your booking ref: {REF_ID} has been cancelled. Necessary refund or exchange has been made as agreed.</p>

<p><em>In some case, we had to cancel the old ticket due to some information changes on the issue ticket. Since our system do not allow us to change any information on the issued ticket, we have to cancel old ticket and re-issue New Ticket No. which will be found at the bottom of this mail. </em></p>

<p>If you should have any question or require anything, please do not hesitate to contact us on +95 (9) 428016234, +95 (1) 569936 or email us ticket@green-myanmar.com.</p>

<p>We hope to serve you again in the future.</p>

<p>{C_REMARK}</p>

<p>&nbsp;</p>

<p>Thanks and Best regards,</p>

<p>Book Myanmar Hotel Ticket Operations Team</p>
','ledgen'=>'{NAME},{REF_ID},{C_REMARK}','created_at' => '2015-06-20 18:50:39','updated_at' => '2015-06-20 18:50:39'),
  array('id' => '10','slug' => 'refund_with_coupon','subject' => 'Book Myanmar Hotel Ticket booking refund coupon','content' => '<p>Dear {NAME},</p>

<p>We would like to inform you that your booking ref: {REF_ID} has been cancelled.</p>

<p>If you should have any question or require anything, please do not hesitate to contact us on +95 (9) 254898 255, +95 (1) 569936 or email us ticket@green-myanmar.com.</p>

<p>Many thanks and We hope to serve you again in the future.</p>

<p>{C_REMARK}</p>

<p>&nbsp;</p>

<p>Best regards,</p>

<p>Book Myanmar Hotel Ticket Operations Team</p>
','mm_subject' => 'Book Myanmar Hotel Ticket booking refund coupon','mm_content' => '<p>Dear {NAME},</p>

<p>We would like to inform you that your booking ref: {REF_ID} has been cancelled.</p>

<p>If you should have any question or require anything, please do not hesitate to contact us on +95 (9) 254898 255, +95 (1) 569936 or email us ticket@green-myanmar.com.</p>

<p>Many thanks and We hope to serve you again in the future.</p>

<p>{C_REMARK}</p>

<p>&nbsp;</p>

<p>Best regards,</p>

<p>BNF Express Ticket Operations Team</p>
','ledgen'=>'{NAME},{REF_ID},{C_REMARK}','created_at' => '2015-06-20 12:20:39','updated_at' => '2015-11-18 19:06:20'),
  array('id' => '11','slug' => 'refund_with_money','subject' => 'Book Myanmar Hotel Ticket booking refunded to your Deposit Account','content' => '<p>Dear {NAME},</p>

<p>We would like to inform you that your booking ref: {REF_ID} has been cancelled. Refund amount of {REFUND_AMOUNT} kyats has been returned back to your deposit account.</p>

<p>If you should have any question or require anything, please do not hesitate to contact us on +95 (9) 254898255, +95 (1) 569936 or email us ticket@green-myanmar.com.</p>

<p>We hope to serve you again in the future.</p>

<p>{C_REMARK}</p>

<p>&nbsp;</p>

<p>Thanks and Best regards,</p>

<p>Book Myanmar Hotel Ticket Operations Team</p>
','mm_subject' => 'Book Myanmar Hotel Ticket booking refunded to your Deposit Account','mm_content' => '<p>Dear {NAME},</p>

<p>We would like to inform you that your booking ref: {REF_ID} has been cancelled. Necessary refund or exchange has been made as agreed.</p>

<p>Refund amount of {REFUND_AMOUNT} kyats has been returned back to your deposit account.</p>

<p>If you should have any question or require anything, please do not hesitate to contact us on +95 (9) 254898255, +95 (1) 569936 or email us ticket@green-myanmar.com.</p>

<p>We hope to serve you again in the future.</p>

<p>{C_REMARK}</p>

<p>&nbsp;</p>

<p>Thanks and Best regards,</p>

<p>Book Myanmar Hotel Ticket Operations Team</p>
','ledgen'=>'{NAME},{REF_ID},{REFUND_AMOUNT},{C_REMARK}','created_at' => '2015-06-20 12:20:39','updated_at' => '2015-11-18 22:28:53')
);

DB::table('email')->insert($email);

    }
}
