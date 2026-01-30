<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

use App\Models\Funnel;
use App\Models\FunnelQuestion;
use App\Models\FunnelQuestionOption;
use App\Models\FunnelRoutingRule;

class MasterFinancialFunnelSeeder extends Seeder
{
    public function run(): void
    {
        // 1) Create Funnel (or update if already exists by slug)
        $funnel = Funnel::updateOrCreate(
            ['slug' => 'master-financial-funnel'],
            [
                'title' => 'Find the Right Financial Strategy for Your Stage of Life',
                'seo_title' => 'Financial Strategy Quiz (US Only)',
                'seo_description' => 'Answer a few quick questions to see options that may fit your goals.',
                'footer_text' => 'Get Financially educated. No obligation. No cost.',
                'is_active' => true,
            ]
        );

        // Optional: wipe existing builder data if re-seeding
        $funnel->questions()->delete();
        $funnel->routingRules()->delete();

        // Helper to create question + options
        $makeQuestion = function (
            int $order,
            string $key,
            string $label,
            string $type,
            bool $required,
            array $options = [],
            ?string $help = null
        ) use ($funnel) {
            $q = FunnelQuestion::create([
                'funnel_id' => $funnel->id,
                'sort_order' => $order,
                'key' => $key,
                'label' => $label,
                'help_text' => $help,
                'type' => $type, // radio, checkbox, text
                'is_required' => $required,
                'is_active' => true,
            ]);

            if (in_array($type, ['radio', 'checkbox'], true)) {
                $i = 1;
                foreach ($options as $opt) {
                    FunnelQuestionOption::create([
                        'funnel_question_id' => $q->id,
                        'sort_order' => $i++,
                        'label' => $opt,
                        'value' => null,
                        'is_active' => true,
                    ]);
                }
            }

            return $q;
        };

        // 2) Questions (Keys are IMPORTANT for routing rules)
        $makeQuestion(
            1,
            'concern',
            "What’s your biggest financial concern right now?",
            'radio',
            true,
            [
                'Planning a secure retirement',
                "Protecting my family’s future",
                'Growing money safely',
                'Reducing market risk',
                'Not sure – need guidance',
            ],
            ''
        );

        $makeQuestion(
            2,
            'age_range',
            'Which age range are you in?',
            'radio',
            true,
            [
                '25–35',
                '36–45',
                '46–55',
                '56–64',
                '65+',
            ]
        );

        $makeQuestion(
            3,
            'employment',
            'Which best describes you?',
            'radio',
            true,
            [
                'W-2 employee',
                'Self-employed / business owner',
                'Retired',
                'Transitioning careers',
            ]
        );

        $makeQuestion(
            4,
            'accounts',
            'Do you currently have any of the following?',
            'checkbox',
            true,
            [
                '401(k) or IRA',
                'Life insurance',
                'Pension or annuity',
                'None / not sure',
            ],
            '“None / not sure” can be treated as high-opportunity.'
        );

        $makeQuestion(
            5,
            'goal',
            'What would you like your money to do most?',
            'radio',
            true,
            [
                'Grow tax-free',
                'Guarantee lifetime income',
                'Protect my family if something happens',
                'Reduce risk from market swings',
                'Leave a legacy',
            ]
        );

        $makeQuestion(
            6,
            'timeline',
            'When are you looking to take action?',
            'radio',
            true,
            [
                'Immediately',
                'In the next 3–6 months',
                'Just researching',
            ]
        );

        // 3) Routing Rules
        // NOTE: priority: higher wins
        // Hybrid should be HIGH if you want "multiple goals" to override others,
        // but we only have one goal question (radio) right now.
        // If you later change Goal to checkbox, Hybrid will start working automatically.

        $createRule = function (
            string $tag,
            int $priority,
            array $conditions,
            string $thankTitle,
            string $thankBody
        ) use ($funnel) {
            FunnelRoutingRule::create([
                'funnel_id' => $funnel->id,
                'tag' => $tag,
                'priority' => $priority,
                'conditions' => $conditions,
                'thankyou_title' => $thankTitle,
                'thankyou_body' => $thankBody,
                'is_active' => true,
            ]);
        };

        // 🟣 HYBRID Strategy (only works if goal becomes checkbox later)
        $createRule(
            'Hybrid_Strategy',
            999,
            [
                ['question_key' => 'goal', 'op' => 'multi_count_gte', 'value' => 2],
            ],
            'You may qualify for a hybrid strategy',
            'Based on your answers, a blended approach may fit best. We’ll help you compare options and pick the best path forward.'
        );

        // 🔴 ANNUITY (59½+ approximated using age ranges 56–64 and 65+)
        $createRule(
            'Annuity_Prospect',
            400,
            [
                ['question_key' => 'age_range', 'op' => 'in', 'value' => ['56–64', '65+']],
                ['question_key' => 'goal', 'op' => 'in', 'value' => ['Guarantee lifetime income', 'Reduce risk from market swings']],
            ],
            'Retire with more certainty',
            'Lifetime income options can help create certainty regardless of market conditions. Next step is a short clarity call.'
        );

        // 🟠 IRA ROLLOVER
        $createRule(
            'IRA_Rollover_Prospect',
            300,
            [
                ['question_key' => 'age_range', 'op' => 'in', 'value' => ['46–55', '56–64']],
                ['question_key' => 'accounts', 'op' => 'contains', 'value' => '401(k) or IRA'],
                ['question_key' => 'concern', 'op' => 'equals', 'value' => 'Planning a secure retirement'],
            ],
            'Rollover options may improve control',
            'Rolling over retirement assets may reduce fees and improve control. We’ll explain options in a simple way.'
        );

        // 🔵 TERM LIFE
        $createRule(
            'Term_Life_Prospect',
            200,
            [
                ['question_key' => 'age_range', 'op' => 'in', 'value' => ['25–35', '36–45']],
                ['question_key' => 'goal', 'op' => 'equals', 'value' => 'Protect my family if something happens'],
            ],
            'Protecting your family starts here',
            'Protecting your family starts with affordable coverage tailored to your stage of life. Let’s review what fits best.'
        );

        // 🟢 IUL
        $createRule(
            'IUL_Prospect',
            100,
            [
                ['question_key' => 'age_range', 'op' => 'in', 'value' => ['25–35', '36–45', '46–55']],
                ['question_key' => 'goal', 'op' => 'in', 'value' => ['Grow tax-free', 'Leave a legacy']],
            ],
            'You may qualify for a tax-advantaged strategy',
            'You may qualify for a strategy that offers growth, protection, and flexibility. Next step is a free 15-minute call.'
        );

        $this->command?->info("✅ Seeded: MASTER FINANCIAL FUNNEL (slug: master-financial-funnel)");
    }
}
