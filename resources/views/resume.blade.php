<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sunhour Heng - Resume</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            @page { size: A4; margin: 20mm; }
        }
    </style>
</head>
<body class="text-gray-800 bg-white font-sans text-sm leading-relaxed">
    <div class="max-w-3xl mx-auto p-8">
        <header class="border-b border-gray-300 pb-4 mb-6">
            <h1 class="text-3xl font-bold">Sunhour Heng</h1>
            <h2 class="text-xl text-gray-600">Full-stack Developer</h2>
            <div class="mt-2 text-sm">
                <p>{{$seeker->address}}</p>
                <p>📞 {{$seeker->phone}} | ✉️ {{ $seeker->address }}</p>
            </div>
        </header>

        <section class="mb-6">
            <h3 class="text-lg font-semibold border-b border-gray-200 mb-2">Profile</h3>
            <p>{{$jobSeeker->description}}</p>
        </section>

        <section class="mb-6">
            <h3 class="text-lg font-semibold border-b border-gray-200 mb-2">Work History</h3>
            <div class="mb-4">
                <p class="font-semibold">Full Stack Web Developer</p>
                <p class="text-sm text-gray-600">Beniten | Feb 2022 - Present</p>
                <ul class="list-disc ml-5 mt-1">
                    <li>Developed efficient and maintainable software according to business objectives.</li>
                    <li>Maintained complex infrastructure and collaborated on feature planning.</li>
                    <li>Built functional databases and back-end applications.</li>
                    <li>Used React.js, Vue.js, SQL, Git, Bootstrap, Tailwind, Laravel.</li>
                </ul>
            </div>
            <div>
                <p class="font-semibold">Backend Developer Intern</p>
                <p class="text-sm text-gray-600">Beniten | Oct 2021 - Feb 2022</p>
                <ul class="list-disc ml-5 mt-1">
                    <li>Worked with Agile/Scrum methodologies.</li>
                    <li>Collaborated with front-end developers for cohesive code design.</li>
                    <li>Developed server-side logic using Laravel.</li>
                </ul>
            </div>
        </section>

        <section class="mb-6">
            <h3 class="text-lg font-semibold border-b border-gray-200 mb-2">Education</h3>
            <p class="mb-2"><span class="font-semibold">Bachelor of Technology in Software Engineering with Multimedia</span><br>Limkokwing University, Phnom Penh | 2017 - 2021</p>
            <p><span class="font-semibold">High School Diploma</span><br>Sovannaphumi School, Takhmau | 2011 - 2017</p>
        </section>

        <section>
            <h3 class="text-lg font-semibold border-b border-gray-200 mb-2">Competencies</h3>
            <ul class="grid grid-cols-2 gap-2 list-disc ml-5">
                <li>PHP Development</li>
                <li>API Integration</li>
                <li>SEO Best Practices</li>
                <li>Application Development</li>
                <li>Responsive Web Design</li>
                <li>Team Collaboration</li>
                <li>Technical Analysis</li>
            </ul>
        </section>
    </div>
</body>
</html>
