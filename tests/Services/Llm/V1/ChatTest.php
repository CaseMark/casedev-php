<?php

namespace Tests\Services\Llm\V1;

use Casedev\Client;
use Casedev\Core\Util;
use Casedev\Llm\V1\Chat\ChatNewCompletionResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

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
    public function testCreateCompletion(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->llm->v1->chat->createCompletion(messages: [[]]);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ChatNewCompletionResponse::class, $result);
    }

    #[Test]
    public function testCreateCompletionWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->llm->v1->chat->createCompletion(
            messages: [['content' => 'content', 'role' => 'system']],
            frequencyPenalty: 0,
            maxTokens: 1000,
            model: 'casemark/casemark-core-3',
            presencePenalty: 0,
            stream: false,
            temperature: 0.7,
            topP: 0,
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ChatNewCompletionResponse::class, $result);
    }
}
