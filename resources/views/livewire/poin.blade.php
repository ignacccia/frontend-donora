@extends('livewire.layout')

@section('content')
<div class="bg-white rounded-2xl p-6 mt-4 flex flex-col shadow-lg z-10 h-full">
    <p class="font-semibold text-3xl text-[#172B4D] drop-shadow">Leadeboard Poin</p>

    <div class="flex items-end ">
        <div class="flex flex-col items-center space-y-2">
            <div class="text-lg font-semibold">User 2</div>
            <div id="bar2" class="bg-red-700 w-10 bar" style="height: 0;"></div>
            <div id="points2" class="text-lg font-semibold">0</div>
        </div>
        <div class="flex flex-col items-center space-y-2">
            <div class="text-lg font-semibold">User 1</div>
            <div id="bar1" class="bg-red-700 w-10 bar" style="height: 0;"></div>
            <div id="points1" class="text-lg font-semibold">0</div>
        </div>
        <div class="flex flex-col items-center space-y-2">
            <div class="text-lg font-semibold">User 3</div>
            <div id="bar3" class="bg-red-700 w-10 bar" style="height: 0;"></div>
            <div id="points3" class="text-lg font-semibold">0</div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Define the heights and points for each bar
    const bars = [{
            id: 'bar1',
            height: 100,
            pointsId: 'points1',
            points: 100
        },
        {
            id: 'bar2',
            height: 80,
            pointsId: 'points2',
            points: 80
        },
        {
            id: 'bar3',
            height: 60,
            pointsId: 'points3',
            points: 60
        },
    ];

    // Animate the bars
    bars.forEach((bar, index) => {
        setTimeout(() => {
            document.getElementById(bar.id).style.height = bar.height + 'px';
            let pointsElement = document.getElementById(bar.pointsId);
            let currentPoints = 0;
            let increment = bar.points / 100;

            let interval = setInterval(() => {
                currentPoints += increment;
                pointsElement.textContent = Math.round(currentPoints);
                if (currentPoints >= bar.points) {
                    clearInterval(interval);
                    pointsElement.textContent = bar.points;
                }
            }, 10);
        }, index * 500); // Stagger the animation start times
    });
});
</script>
@endsection