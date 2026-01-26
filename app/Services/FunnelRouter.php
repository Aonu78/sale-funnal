<?php

namespace App\Services;

use App\Models\Funnel;
use App\Models\FunnelRoutingRule;

class FunnelRouter
{
    public function pickTag(Funnel $funnel, array $answersByKey): ?FunnelRoutingRule
    {
        $rules = $funnel->routingRules()->where('is_active', true)->get();

        foreach ($rules as $rule) {
            if ($this->matches($rule->conditions ?? [], $answersByKey)) {
                return $rule;
            }
        }
        return null;
    }

    private function matches(array $conditions, array $answersByKey): bool
    {
        foreach ($conditions as $c) {
            $key = $c['question_key'] ?? null;
            $op  = $c['op'] ?? null;
            $val = $c['value'] ?? null;

            if (!$key || !$op) return false;

            $answer = $answersByKey[$key] ?? null;

            // normalize checkbox answers as array
            $answerArr = is_array($answer) ? $answer : ($answer !== null ? [$answer] : []);

            if ($op === 'equals') {
                if ((string)$answer !== (string)$val) return false;
            }

            if ($op === 'in') {
                $set = is_array($val) ? $val : [$val];
                $found = false;
                foreach ($answerArr as $a) {
                    if (in_array($a, $set, true)) { $found = true; break; }
                }
                if (!$found) return false;
            }

            if ($op === 'contains') {
                if (!is_array($answer)) return false;
                if (!in_array($val, $answer, true)) return false;
            }

            if ($op === 'multi_count_gte') {
                $n = (int)$val;
                if (count($answerArr) < $n) return false;
            }
        }
        return true;
    }
}
