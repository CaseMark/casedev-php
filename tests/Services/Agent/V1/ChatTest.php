<?php

namespace Tests\Services\Agent\V1;

use CaseDev\Agent\V1\Chat\ChatCancelResponse;
use CaseDev\Agent\V1\Chat\ChatDeleteResponse;
use CaseDev\Agent\V1\Chat\ChatNewResponse;
use CaseDev\Client;
use CaseDev\Core\Util;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class ChatTest extends TestCase
{
    protected Client $client;

    protected function setUp(): void
    {
        parent::setUp();

        $testUrl = Util::getenv('TEST_API_BASE_URL') ?: 'http://127.0.0.1:4010';
        $client = new Client(apiKey: 'My API Key', baseUrl: $testUrl);

        $this->client = $client;
    }

    #[Test]
    public function testCreate(): void
    {
        $result = $this->client->agent->v1->chat->create();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ChatNewResponse::class, $result);
    }

    #[Test]
    public function testDelete(): void
    {
        $result = $this->client->agent->v1->chat->delete('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ChatDeleteResponse::class, $result);
    }

    #[Test]
    public function testCancel(): void
    {
        $result = $this->client->agent->v1->chat->cancel('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ChatCancelResponse::class, $result);
    }

    #[Test]
    public function testReplyToQuestion(): void
    {
        $result = $this->client->agent->v1->chat->replyToQuestion(
            'requestID',
            id: 'id',
            answers: [['string']]
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testReplyToQuestionWithOptionalParams(): void
    {
        $result = $this->client->agent->v1->chat->replyToQuestion(
            'requestID',
            id: 'id',
            answers: [['string']]
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testSendMessage(): void
    {
        $result = $this->client->agent->v1->chat->sendMessage('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }
}
