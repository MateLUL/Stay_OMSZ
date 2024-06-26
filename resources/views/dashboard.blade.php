<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Főoldal') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 view-reports-padding">
                            <p class="top5">Top 5 jelentésíró a héten</p>

                            @if ($topReports->isEmpty())
                            <p>Még senki nem csinált semmit :(</p>
                            @else
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Név</th>
                                        <th scope="col">Jelentések</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($topReports as $topReport)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $topReport->charactername }}</td>
                                        <td>{{ $topReport->reportCount }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 view-reports-padding">
                            <p class="top5">Statisztikák</p>
                            <p><b>Jelentéseid száma:</b> {{ $reportCount }}</p>
                            @if ($minimumReportCount - $reportCount > 0)
                                <p><i>(Minimum jelentés számhoz <b>{{ $minimumReportCount - $reportCount }} darab</b> kell még)</i></p>
                            @else
                                <p><i>(<b>Megvan</b> a minimum jelentés számod)</i></p>
                            @endif

                            @if ($lastReportDate != '-')
                                <p><b>Utolsó felvitt jelentésed:</b> {{ \Illuminate\Support\Carbon::parse($lastReportDate)->format('Y.m.d H:i') }} </p>                                
                            @endif
                            <p>Az összes leadott jelentés <b>{{ $userReportPercentage }}%</b>-át te adtad le.</p>

                            <br>

                            @if ($dutyMinuteSum == null)
                                <p><b>Szolgálati idő:</b> 0 perc</p>
                                <p><i>(Minimum szolgálati időhöz <b>500 perc</b> kell még)</i></p>
                            @else
                                <p><b>Szolgálati idő:</b> {{ $dutyMinuteSum }} perc</p>
                                @if ($minimumDutyTime - $dutyMinuteSum > 0)
                                    <p><i>(Minimum szolgálati időhöz <b>{{ $minimumDutyTime - $dutyMinuteSum }} perc</b> kell még)</i></p>
                                @else
                                    <p><i>(<b>Megvan</b> a minimum szolgálati időd)</i></p>
                                @endif
                            @endif
                            <p>Ennyi időt kell még szolgálatban lenned, hogy első legyél: <b>{{ $minutesUntilTopDutyTime }}</b> perc</p>
                            
                            <br>

                            <p><b>Összes jelentés száma:</b> {{ $allReportCount }}</p>
                            @if ($sumDutyTime == 0)
                                <p>Az OMSZ eddig összesen <b>0 percet</b> töltött szolgálatban</p>
                            @else
                                <p>Az OMSZ eddig összesen <b>{{ $sumDutyTime }} percet</b> töltött szolgálatban</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
