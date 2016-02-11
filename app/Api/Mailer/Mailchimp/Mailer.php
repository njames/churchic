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
        // TODO: Implement batchSubscribe() method.
    }

    /**
     * @param $ListId
     * @param $Emails
     * @return mixed
     */
    public function batchUnsubscribe($ListId, $Emails)
    {
        // TODO: Implement batchUnsubscribe() method.
    }
}