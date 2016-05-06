<?php  namespace ChurchIC\Api\Mailer\Mailchimp;

use ChurchIC\Api\Mailer\MailerInterface;
use ChurchIC\Models\ApiConnection;
use ChurchIC\Models\ClientConnection;
use DrewM\MailChimp\MailChimp as MailChimpSDK;
use \DrewM\MailChimp\Batch;
/**
 * @author nigeljames
 * @date   11/02/16 8:12 PM
 */
class Mailer implements MailerInterface {

    protected $mailchimp;
    protected $clientId;
    protected $source;

    function __construct($clientId)
    {
        $this->source = 'Mailchimp';
        $this->mailchimp = $this->connect($clientId);

    }

    /**
     * Get the apikey for connecting to mailchimp
     * @return mixed
     */
    public function connect($clientId)
    {
        $connection = ApiConnection::where('team_id', '=', $clientId)
                                      ->where('source_name', '=', $this->source )->first();

        return new MailChimpSDK($connection->apikey);
    }

    /**
     * @return mixed
     */
    public function getLists()
    {
        return $this->mailchimp->get('lists');
    }

    /**
     * @param $listId
     * @return mixed
     */
    public function getListMembers($listId)
    {
        return $this->mailchimp->get("/lists/$listId/members");
    }


    /**
     * @param $listId
     * @param $email
     */
    public function subscribe($listId, $email)
    {

    }

    /**
     * @param $listId
     * @param $email
     */
    public function unSubscribe($listId, $email)
    {

    }

    /**
     * @param $listId
     * @param $email
     */
    public function update($listId, $email)
    {

    }

    /**
     * @param $listId
     * @param $emails
     * @return mixed
     */
    public function batchSubscribe($listId, $emails)
    {
        $batch = $this->mailchimp->new_batch();
        $operation  = 0;

        foreach ($emails as $email) {
            $operation++;
            $batch->post( 'BS' . $operation , "lists/$listId/members", [
                'email_address' => $email->email,
                'status' => 'subscribed',
            ]);
        }

        return $batch->execute();

    }

    /**
     * @param $listId
     * @param $emails
     */
    public function batchUpdate($listId, $emails){

        $batch = $this->mailchimp->new_batch();
        $operation  = 0;

        foreach ($emails as $email) {
            $operation++;
            $hash = $this->mailchimp->subscriberHash($email->email);

            $batch->patch( 'BU' . $operation , "lists/$listId/members/$hash", [
                'email_address' => $email->email,
                'status' => 'subscribed',
            ]);
        }

        return $batch->execute();



    }

    /**
     * @param $listId
     * @param $emails
     * @return $batchId to use later with checkBatch
     */
    public function batchUnsubscribe($listId, $emails)
    {
        $batch = $this->mailchimp->new_batch();
        $operation  = 0;

        foreach ($emails as $email) {
            $hash = $this->mailchimp->subscriberHash($email->email);
            $operation++;
            $batch->delete( 'BD' . $operation , "lists/$listId/members/$hash");
        }


//        eval(\Psy\sh());
        return $batch->execute();

    }

    /**
     * @param $batchId
     * @return mixed
     */
    public function checkBatch($batchId){

        $batch = $this->mailchimp->new_batch($batchId);

       return $batch->check_status();

//        eval(\Psy\sh());
    }
}