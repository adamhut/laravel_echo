<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/4.13.0/bodymovin.min.js" type="text/javascript"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
    <title>404</title>
    <style>
    </style>
</head>
<body class="bg-blue-darker overflow-hidden p-8 md:p-0">
    <div class="container mx-auto text-center md:text-left h-full">
        <div class="md:absolute h-full flex flex-col justify-center z-10">
            <h1 class="text-white font-normal tracking-wide text-4xl mb-6">You have ventured into 404 space!!</h1>
            <p class="text-grey-dark mb-8 text-xl leading-normal font-lighter">
                The requested URL /404 was not found on this server. That’s all we know.
            </p>
            <div class="flex flex-col md:flex-row justify-between mt-6 ">
                <a class="flex-1 text-center mr-8 font-semibold border-2 border-grey-dark rounded-full p-4 no-underline text-grey-ligher uppercase tracking-wide hover:border-red text-white" href="/">Bring me home</a>
                <a class="flex-1 text-center mr-8 font-semibold border-2 border-green-dark rounded-full p-4 no-underline text-grey-ligher uppercase tracking-wide hover:border-red text-white" href="https:://client-potal.bcrcopr.com.au">Login to MyBCR</a>
            </div>
        </div>
        </div>
    <div id="lottie" class="w-full h-full hidden md:block"></div>

     <script>
        var animation = bodymovin.loadAnimation({
            container: document.getElementById('lottie'), // Required
            path: 'js/errors/data.json', // Required
            renderer: 'svg', // Required
            loop: false, // Optional
            autoplay: true, // Optional
            name: "404", // Name for future reference. Optional.
        })
    </script>
</body>
</html>