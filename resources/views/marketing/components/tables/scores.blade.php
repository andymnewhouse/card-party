@props(['players', 'scores'])

<div class="flex flex-col">
    <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
        <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
            <table class="table">
                <thead>
                    <tr>
                        <th></th>
                        @foreach($players as $player)
                        <th>{{ $player->firstname }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($scores as $index => $round)
                    <tr>
                        <td>Round {{ $index + 1 }}</td>
                        @foreach($players as $player)
                        <td class="text-right">{{ $round->scores->firstWhere('user_id', $player->id)['total'] }}</td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td>Total</td>
                        @foreach($players as $player)
                        <td class="text-right">
                            {{ $scores->pluck('scores')->sum(function($item) use ($player) { return $item->firstWhere('user_id', $player->id)['total']; }) }}
                        </td>
                        @endforeach
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>