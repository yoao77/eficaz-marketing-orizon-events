<?

namespace App\Contracts;

interface SubscriptionRepositoryContract
{
    public function subscribe(int $eventId, int $userId);
    public function unsubscribe(int $eventId, int $userId);
}
