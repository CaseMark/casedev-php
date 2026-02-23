<?php

namespace Tests\Services\Llm\V1;

use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Router\Client;
use Router\Core\Util;
use Router\Llm\V1\Chat\ChatNewCompletionResponse;

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
        $result = $this->client->llm->v1->chat->createCompletion(messages: [[]]);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ChatNewCompletionResponse::class, $result);
    }

    #[Test]
    public function testCreateCompletionWithOptionalParams(): void
    {
        $result = $this->client->llm->v1->chat->createCompletion(
            messages: [['content' => 'content', 'role' => 'system']],
            casemarkShowReasoning: false,
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
