<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Personal Homepage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- HEADER: Carousel (12 grid) -->
<div class="container-fluid p-0">
    <div id="headerCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://picsum.photos/id/1015/1920/400" class="d-block w-100" alt="Slide 1" style="height: 400px; object-fit: cover;">
                <div class="carousel-caption d-none d-md-block">
                    <h1>Welcome to My Personal Homepage</h1>
                    <p>Get to know me better</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://picsum.photos/id/1016/1920/400" class="d-block w-100" alt="Slide 2" style="height: 400px; object-fit: cover;">
                <div class="carousel-caption d-none d-md-block">
                    <h1>My Journey</h1>
                    <p>Education & Experience</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://picsum.photos/id/1018/1920/400" class="d-block w-100" alt="Slide 3" style="height: 400px; object-fit: cover;">
                <div class="carousel-caption d-none d-md-block">
                    <h1>Let's Connect</h1>
                    <p>Find me on social media</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#headerCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#headerCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>
</div>