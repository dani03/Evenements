
<x-app-layout>
<div class="flex flex-wrap">
  @foreach($events as $event)
    
  <div class="min-h-screen bg-gray-200 flex justify-center items-center {{ $event->premium ? 'border border-yellow-500': ''}} ">
    <!-- Start of component -->
    <div class="max-w-sm bg-white border-2 border-gray-300 p-6 rounded-md tracking-wide shadow-lg">
       <div id="header" class="flex items-center mb-4"> 
          <img alt="avatar" class="w-20 rounded-full border-2 border-gray-300" src="https://picsum.photos/seed/picsum/200" />
          <div id="header-text" class="leading-5 ml-6 sm">
             <h4 id="name" class="text-xl font-semibold">{{$event->user->name}}</h4>
             <h5 id="job" class="font-semibold text-blue-600">Designer</h5>
             <h5 id="job" class="font-semibold text-blue-600"> date debut: {{$event->start_at->translatedFormat('M')}}</h5>
             <h5 id="job" class="font-semibold text-blue-600"> date debut: {{$event->start_at->translatedFormat('d')}}</h5>
             <h5 id="job" class="font-semibold text-blue-600"> date fin: {{$event->end_at->translatedFormat('M')}}</h5>
             <h5 id="job" class="font-semibold text-blue-600"> date fin: {{$event->end_at->translatedFormat('d')}}</h5>
            <p>{{$event->description}}</p>
            </div>
       </div>
       <div id="quote">
         @foreach ($event->tags as $tag)
          <q class="italic text-gray-600">{{$tag->name}} {{!$loop->last ? ',' : ''}}</q>
          @endforeach
       </div>
           
    </div>
    <!-- End of component -->
 </div>
  @endforeach
</div>
 

</x-app-layout>