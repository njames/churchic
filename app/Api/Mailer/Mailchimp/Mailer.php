<?php  namespace Cic\Api\Mailer\Mailchimp;

use Cic\Api\Mailer\MailerInterface;
use Cic\Models\ClientConnection;
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
        $connection = ClientConnection::where('client_id', '=', $clientId)
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
     * @param $ListId
     * @return mixed
     */
    public function getListMembers($ListId)
    {
        return $this->mailchimp->get("/lists/$ListId/members");
    }

    /**
     * @param $ListId
     * @param $Emails
     * @return mixed
     */
    public function batchSubscribe($ListId, $Emails)
    {
        $batch = $this->mailchimp->new_batch();
        $operation  = 0;

        foreach ($Emails as $Email) {
            $operation++;
            $batch->post( 'BS' . $operation , "lists/$ListId/members", [
                'email_address' => $Email->email,
                'status' => 'subscribed',
            ]);
        }

        return $batch->execute();

    }

    public function batchUpdate($ListId, $Emails){

    }

    /**
     * @param $ListId
     * @param $Emails
     * @return $batchId to use later with checkBatch
     */
    public function batchUnsubscribe($ListId, $Emails)
    {
        $batch = $this->mailchimp->new_batch();
        $operation  = 0;

        foreach ($Emails as $Email) {
            $hash = $this->mailchimp->subscriberHash($Email->email);
            $operation++;
            $batch->delete( 'BD' . $operation , "lists/$ListId/members/$hash");
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