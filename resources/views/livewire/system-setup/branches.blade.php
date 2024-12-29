<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Branches') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('The list of your shops and stores of your company.') }}
        </p>
    </header>

    <div class="my-2">
        <livewire:system-setup.create-branch />
    </div>

    <div class="md__table_wrapper">
        <table class="md__table">
            <thead class="md__thead">
                <tr>
                    <th class="md__th">S/N</th>
                    <th class="md__th">NAME</th>
                    <th class="md__th">PHONE</th>
                    <th class="md__th">ADDRESS</th>
                    <th class="md__th">TAX ID</th>
                    <th class="md__th"></th>
                </tr>
            </thead>
            <tbody class="md__tbody">
                @php
                $rowId = 1;
                @endphp
                @foreach ($branches as $branch)
                    <tr wire:key="{{ $branch->id }}" class="md__tr">
                        <td class="md__td">{{ $rowId++ }}</td>
                        <td class="md__td">{{ $branch->name }}</td>
                        <td class="md__td">{{ $branch->phone }}</td>
                        <td class="md__td">{{ $branch->address }}</td>
                        <td class="md__td">{{ $branch->taxt_id }}</td>
                        <td class="md__td">
                            <div class="flex items-center gap-2">
                                <livewire:system-setup.update-branch :branch="$branch" :key="$branch->id" />
                                <button wire:click="deleteBranch({{$branch->id}})" 
                                        wire:confirm.prompt="Are you sure that you want to delete - {{ $branch->name }}?\n\nType DELETE to confirm|DELETE"
                                >
                                    <x-heroicon-o-trash class="size-5 text-red-500" />
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
