<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Domain\Entities\Command;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class CommandRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'commands' => ['required', 'array', 'min:1'],
            'commands.*' => [Rule::in(Command::TYPES)],
            'start_position.x' => ['required', 'int'],
            'start_position.y' => ['required', 'int'],
        ];
    }

    public function hasStartPosition(): bool
    {
        return isset($this->start_position['x']);
    }
}
