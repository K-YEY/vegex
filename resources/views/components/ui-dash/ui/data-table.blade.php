@props([
    'title' => '',
    'subtitle' => '',
    'id' => 'datatable-search',
    'columns' => [],
])

<div class="card">
    <!-- Card header -->
    <div class="card-header">
        @if ($title)
            <h5 class="mb-0">{{ $title }}</h5>
        @endif
        @if ($subtitle)
            <p class="text-sm mb-0">{{ $subtitle }}</p>
        @endif
    </div>
    <div class="table-responsive">
        <table class="table table-flush" id="{{ $id }}">
            <thead class="thead-light">
                <tr>
                    @foreach ($columns as $column)
                        <th>{{ $column }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                {{ $slot }}
            </tbody>
        </table>
    </div>
</div>
<script src="{{ asset('app/assets/js/plugins/data-table.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dataTable = new simpleDatatables.DataTable('#{{ $id }}', {
            searchable: true,
            fixedHeight: true
        });
    });
</script>
