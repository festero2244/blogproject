<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Blog Page</title>
</head>
<body>
    <div class="w-4/5 m-auto text-left">
        <div class="py-15">
            <h1 class="text-6xl pt-30">
                {{ $post->title }}
            </h1>
        </div>
    </div>

    <div class="w-4/5 m-auto pt-20">
        <span class="text-gray-500">
            By <span class=" font-bold italic text-gray-800">
                {{ $post->user->name }}
            </span>, Created on {{ date('jS M Y', strtotime($post->updated_at)) }}
        </span>
        <P class="text-xl text=gray-700 pt-8 pb-10 leading-8 font-light">
        {{ $post->description }}
        </P>
    </div>
    
</body>
</html>

