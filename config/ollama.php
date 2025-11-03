<?php

$defaultParserPrompt = 'You are a data extractor. Your task is to read any message from the user and identify any information about the user that corresponds to the following fields: first_name, last_name, address, height (in cm), weight (in kg), gender (if non info, try to guess by name, use only male or female), age (in years). The user may write in natural language and not explicitly label the fields. Extract only the information you can find and return it as a JSON object. Do not include fields with no values. The JSON must be the only output, no explanations or extra text. Field names: first_name, last_name, address, height, weight, gender, age';

return [
    'url' => env('OLLAMA_API_URL', 'http://localhost:11434/api/chat'),
    'model' => env('OLLAMA_MODEL', 'llama3.1:8b'),
    'parser_prompt' => env('OLLAMA_PARSER_PROMPT', $defaultParserPrompt),
];
