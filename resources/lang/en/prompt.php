<?php

return [
    'report' => 'Generate a report in the past tense for :person. '
        . 'Task: :task. '
        . 'Brief summary of the work done: :description. '
        . 'Exclude introductory and concluding phrases, and provide additional details about the completed work. '
        . 'If the specified time spent, :spent_time, seems underestimated, indicate the realistic time '
        . 'required to complete the task.',

    'gemini' => 'Generate a report in the past tense for :person. '
        . 'Task: :task. '
        . 'Brief summary of the work done: :description. '
        . 'Time spent: :spent_time. '

        . 'Based on the task and brief summary, generate a single cohesive paragraph providing a detailed description of the work performed, including implementation details. '
        . 'Specify concrete actions while avoiding references to specific tools; instead, use general terms. '
        . 'Describe all stages sequentially. '
        . 'Each sentence in this paragraph must STRICTLY start with a verb in the past perfect tense, describing a SPECIFIC action. '
        . 'Exclude the use of introductory words and phrases. '
        . 'Also, EXCLUDE any descriptions that do not add new information about the work done, such as descriptions of obvious results. '
        . 'STRICTLY AVOID using headings, lists, bullet points, numbering, tables, or any other formatting elements other than plain text. '
        . 'At the end of this paragraph, append the following sequence of characters: `----`. '

        . 'CRITICALLY EVALUATE the adequacy of the specified completion time. '
        . 'DO NOT REPEAT THE ORIGINAL TIME WITHOUT ARGUMENTATION. '
        . 'If the time appears underestimated, provide a total reasonable time for completion. '
        . 'Even if the time seems reasonable, present an alternative, more detailed estimate, '
        . 'considering possible delays, challenges, and the need for thorough validation, '
        . 'breaking it down into stages (e.g., analysis - X minutes, development - Y minutes, testing - Z minutes). '
        . 'Explain why each stage requires the specified time. '
        . 'The rationale must be provided in a separate paragraph. '

        . 'The response must contain exactly two paragraphs. '
        . 'Any other formatting is unacceptable. '
        . 'Do not duplicate information about the employee in the report.',
];
