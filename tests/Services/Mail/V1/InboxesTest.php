<?php

namespace Tests\Services\Mail\V1;

use CaseDev\Client;
use CaseDev\Core\Util;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class InboxesTest extends TestCase
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
        $result = $this->client->mail->v1->inboxes->create();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->mail->v1->inboxes->retrieve('inboxId');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testList(): void
    {
        $result = $this->client->mail->v1->inboxes->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testDelete(): void
    {
        $result = $this->client->mail->v1->inboxes->delete('inboxId');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testGetAttachment(): void
    {
        $result = $this->client->mail->v1->inboxes->getAttachment(
            'attachmentId',
            inboxID: 'inboxId',
            messageID: 'messageId'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testGetAttachmentWithOptionalParams(): void
    {
        $result = $this->client->mail->v1->inboxes->getAttachment(
            'attachmentId',
            inboxID: 'inboxId',
            messageID: 'messageId'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testGetMessage(): void
    {
        $result = $this->client->mail->v1->inboxes->getMessage(
            'messageId',
            inboxID: 'inboxId'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testGetMessageWithOptionalParams(): void
    {
        $result = $this->client->mail->v1->inboxes->getMessage(
            'messageId',
            inboxID: 'inboxId'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testGetPolicy(): void
    {
        $result = $this->client->mail->v1->inboxes->getPolicy('inboxId');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testListMessages(): void
    {
        $result = $this->client->mail->v1->inboxes->listMessages('inboxId');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testReply(): void
    {
        $result = $this->client->mail->v1->inboxes->reply(
            'messageId',
            inboxID: 'inboxId'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testReplyWithOptionalParams(): void
    {
        $result = $this->client->mail->v1->inboxes->reply(
            'messageId',
            inboxID: 'inboxId'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testSend(): void
    {
        $result = $this->client->mail->v1->inboxes->send('inboxId');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testSetPolicy(): void
    {
        $result = $this->client->mail->v1->inboxes->setPolicy('inboxId');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }
}
