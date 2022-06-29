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
                Create Posts
            </h1>
        </div>
    </div>
    
    @if($errors->any())
        <div class="w-4/5 m-auto">
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="w-1/5 mb-4 text-gray-50 bg-red-700 rounded-2xl py-4">
                        {{ $error }}
                    </li>
                @endforeach
            </ul>
        </div>

    @endif

    <div class="w-4/5 m-auto pt-20">
        <form action="/blog" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="text" name="title" placeholder="Title..."
            class="bg-transparent block border-b-2 w-full h-20 text-6xl
            outline-none">

            <textarea name="description" placeholder="Description..."
            class="py-20 bg-transparent block border-b-2
            w-full h-60 text-xl outline-none" ></textarea>

            <div class="bg-gray=lighter pt-15 ">
                <label class="w-44 flex flex-co items-center px-2 py-3 bg-white-rounded-lg
                shadow-lg tracking-widr uppercase border border-blue cursor-pointer">
                <span class="mt-2 text-base leading-normal">
                    Select a file
                </span>
                <input type="file" name="image" class="hidden">
            </label>
            </div>

            <button type="submit"
    class="uppercase mt-15 bg-blue-500 text-gray-100 text-large
    font-extrabold py-4 px-8 rounded-3xl">
        Submit Post
    </button>
        </form>
    </div>
    
</body>
</html>

