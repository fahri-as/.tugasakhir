<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Evaluations') }}
            </h2>
            <x-button href="{{ route('evaluasi.create') }}">
                {{ __('New Evaluation') }}
            </x-button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <x-alert type="success" class="mb-4">
                    {{ session('success') }}
                </x-alert>
            @endif

            <x-card>
                <x-table :headers="['Intern', 'Period', 'Score', 'Status', 'Actions']">
                    @foreach($evaluations as $evaluation)
                        <tr>
                            <td class="table-cell">{{ $evaluation->intern->name }}</td>
                            <td class="table-cell">{{ $evaluation->period->name }}</td>
                            <td class="table-cell">{{ $evaluation->score }}</td>
                            <td class="table-cell">
                                <span class="badge {{ $evaluation->status === 'Passed' ? 'badge-success' : 'badge-danger' }}">
                                    {{ $evaluation->status }}
                                </span>
                            </td>
                            <td class="table-cell">
                                <a href="{{ route('evaluasi.edit', $evaluation) }}" class="table-action">
                                    Edit
                                </a>
                                <form action="{{ route('evaluasi.destroy', $evaluation) }}" method="POST" class="inline"
                                      onsubmit="return confirmAction('Are you sure you want to delete this evaluation?', () => true)">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-action">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </x-table>

                <div class="mt-4">
                    {{ $evaluations->links() }}
                </div>
            </x-card>
        </div>
    </div>
</x-app-layout>
