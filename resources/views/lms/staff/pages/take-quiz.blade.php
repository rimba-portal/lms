<x-filament-panels::page>
    <form wire:submit.prevent="submit" class="space-y-6">
        <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-900">
            <div class="space-y-1">
                <h2 class="text-xl font-semibold">{{ $quiz->name }}</h2>

                @if ($quiz->description)
                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ $quiz->description }}</p>
                @endif

                <div class="text-sm text-gray-500 dark:text-gray-400">Passing score: {{ $quiz->pass_score }}%</div>
            </div>
        </div>

        @foreach ($questions as $index => $question)
            @php
                $snapshot = $question['snapshot'];
                $type = $snapshot['type'] ?? 'single_choice';
                $questionText = $snapshot['question'] ?? 'Question';
                $options = $snapshot['options'] ?? [];
            @endphp

            <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-900">
                <div class="mb-4 space-y-1">
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        Question {{ $index + 1 }}
                        @if (! empty($question['points_available']))
                            · {{ $question['points_available'] }} point(s)
                        @endif
                    </div>

                    <div class="text-base font-semibold text-gray-950 dark:text-white">{{ $questionText }}</div>
                </div>

                @if ($type === 'single_choice')
                    <div class="space-y-3">
                        @foreach ($options as $option)
                            <label class="flex cursor-pointer items-start gap-3 rounded-lg border border-gray-200 p-3 hover:bg-gray-50 dark:border-gray-700 dark:hover:bg-gray-800">
                                <input
                                    type="radio"
                                    wire:model.defer="answers.{{ $question['id'] }}"
                                    value="{{ $option['key'] ?? '' }}"
                                    class="mt-1"
                                />

                                <span> {{ $option['label'] ?? $option['key'] ?? '' }} </span>
                            </label>
                        @endforeach
                    </div>
                @elseif ($type === 'multiple_choice')
                    <div class="space-y-3">
                        @foreach ($options as $option)
                            <label class="flex cursor-pointer items-start gap-3 rounded-lg border border-gray-200 p-3 hover:bg-gray-50 dark:border-gray-700 dark:hover:bg-gray-800">
                                <input
                                    type="checkbox"
                                    wire:model.defer="answers.{{ $question['id'] }}"
                                    value="{{ $option['key'] ?? '' }}"
                                    class="mt-1"
                                />

                                <span> {{ $option['label'] ?? $option['key'] ?? '' }} </span>
                            </label>
                        @endforeach
                    </div>
                @elseif ($type === 'true_false')
                    <div class="space-y-3">
                        <label class="flex cursor-pointer items-start gap-3 rounded-lg border border-gray-200 p-3 hover:bg-gray-50 dark:border-gray-700 dark:hover:bg-gray-800">
                            <input
                                type="radio"
                                wire:model.defer="answers.{{ $question['id'] }}"
                                value="true"
                                class="mt-1"
                            />

                            <span>True</span>
                        </label>

                        <label class="flex cursor-pointer items-start gap-3 rounded-lg border border-gray-200 p-3 hover:bg-gray-50 dark:border-gray-700 dark:hover:bg-gray-800">
                            <input
                                type="radio"
                                wire:model.defer="answers.{{ $question['id'] }}"
                                value="false"
                                class="mt-1"
                            />

                            <span>False</span>
                        </label>
                    </div>
                @elseif ($type === 'short_answer')
                    <input
                        type="text"
                        wire:model.defer="answers.{{ $question['id'] }}"
                        class="block w-full rounded-lg border-gray-300 shadow-sm dark:border-gray-700 dark:bg-gray-800"
                    />
                @else
                    <textarea
                        wire:model.defer="answers.{{ $question['id'] }}"
                        rows="4"
                        class="block w-full rounded-lg border-gray-300 shadow-sm dark:border-gray-700 dark:bg-gray-800"
                    ></textarea>
                @endif
            </div>
        @endforeach

        <div class="flex items-center justify-end gap-3">
            <x-filament::button type="submit" color="primary" wire:loading.attr="disabled">
                Submit Quiz
            </x-filament::button>
        </div>
    </form>
</x-filament-panels::page>
