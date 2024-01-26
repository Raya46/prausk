<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  <title>EFintech</title>
</head>
<body>
<div class="hero min-h-screen bg-base-200">
    <div class="hero-content flex-col">
      <div class="text-center lg:text-left">
        <h1 class="text-5xl font-bold mb-2">Register now!</h1>
      </div>
      <div class="card shrink-0 w-full max-w-sm shadow-2xl bg-base-100">
        <form class="card-body" method="POST" action="/post-register">
            @csrf
          <div class="form-control">
            <label class="label">
              <span class="label-text">Name</span>
            </label>
            <input type="text" required placeholder="name" name="name" class="input input-bordered" required />
          </div>
          <div class="form-control">
            <label class="label">
              <span class="label-text">Password</span>
            </label>
            <input type="password" required placeholder="password" name="password" class="input input-bordered" required />
            <label class="label">
              <a href="/login" class="label-text-alt link link-hover">Already have account?</a>
            </label>
          </div>
          <div class="form-control mt-6">
            <button class="btn btn-primary">register</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>

