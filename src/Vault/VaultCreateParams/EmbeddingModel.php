<?php

declare(strict_types=1);

namespace CaseDev\Vault\VaultCreateParams;

/**
 * Optional embedding model for this vault. Defaults to casemark/embed-v1. Determines the S3 Vectors index dimension and which model is used at both ingest and search time. The vault is locked to this model after creation — use a re-embed flow to change later. Ignored when enableIndexing is false. Note: `casemark/llama-nemotron-embed-vl-1b-v2` is a deprecated alias for `casemark/embed-v1` (retained for SDK backward compatibility); new integrations should use `casemark/embed-v1` directly.
 */
enum EmbeddingModel: string
{
    case OPENAI_TEXT_EMBEDDING_3_SMALL = 'openai/text-embedding-3-small';

    case OPENAI_TEXT_EMBEDDING_3_LARGE = 'openai/text-embedding-3-large';

    case VOYAGE_VOYAGE_3_5 = 'voyage/voyage-3.5';

    case VOYAGE_VOYAGE_LAW_2 = 'voyage/voyage-law-2';

    case COHERE_EMBED_V4_0 = 'cohere/embed-v4.0';

    case GOOGLE_GEMINI_EMBEDDING_2 = 'google/gemini-embedding-2';

    case CASEMARK_EMBED_V1 = 'casemark/embed-v1';

    case CASEMARK_LLAMA_NEMOTRON_EMBED_VL_1B_V2 = 'casemark/llama-nemotron-embed-vl-1b-v2';
}
