<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Simple Resume</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-gray-800 font-sans p-8 max-w-3xl mx-auto">

  <!-- Header -->
  <header class="mb-6">
    <h1 class="text-3xl font-bold">John Doe</h1>
    <p class="text-gray-600">Software Developer</p>
    <div class="text-sm text-gray-600 mt-2">
      <p>Email: john.doe@example.com | Phone: (123) 456-7890 | Location: New York, NY</p>
    </div>
  </header>

  <!-- Summary -->
  <section class="mb-6">
    <h2 class="text-xl font-semibold border-b pb-1 mb-2">Summary</h2>
    <p class="text-sm leading-relaxed">
      Passionate developer with 5+ years of experience in web applications, APIs, and scalable microservices.
      Proficient in Laravel, Tailwind, and modern dev workflows.
    </p>
  </section>

  <!-- Experience -->
  <section class="mb-6">
    <h2 class="text-xl font-semibold border-b pb-1 mb-2">Experience</h2>
    <div class="mb-4">
      <h3 class="text-md font-semibold">Senior Developer – ABC Corp</h3>
      <p class="text-sm text-gray-500">Jan 2021 – Present</p>
      <ul class="list-disc list-inside text-sm mt-1">
        <li>Built and maintained microservices using Laravel and RabbitMQ.</li>
        <li>Led a team of 4 developers; enforced code quality and CI/CD best practices.</li>
      </ul>
    </div>
    <div>
      <h3 class="text-md font-semibold">Backend Developer – XYZ Inc</h3>
      <p class="text-sm text-gray-500">Jul 2018 – Dec 2020</p>
      <ul class="list-disc list-inside text-sm mt-1">
        <li>Worked on RESTful APIs and background jobs using Laravel Horizon.</li>
        <li>Optimized SQL queries and improved API response times by 40%.</li>
      </ul>
    </div>
  </section>

  <!-- Education -->
  <section class="mb-6">
    <h2 class="text-xl font-semibold border-b pb-1 mb-2">Education</h2>
    <p class="text-sm">
      B.Sc. in Computer Science<br />
      University of Technology, 2014 – 2018
    </p>
  </section>

</body>
</html>
