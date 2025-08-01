
<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Organic Farming | Trisha Dutta</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: Arial, sans-serif;
    }

    body {
      scroll-behavior: smooth;
    }

    nav {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 1rem 2rem;
      background-color: rgba(0, 100, 0, 0.8);
      position: fixed;
      width: 100%;
      top: 0;
      z-index: 999;
    }
    

    nav .logo {
      color: white;
      font-size: 1.5rem;
      font-weight: bold;
    }

    nav ul {
      display: flex;
      list-style: none;
      position: relative;
      
    }

    nav ul li {
      margin: 0 1rem;
      position: relative;
    }

    nav ul li a {
      color: white;
      text-decoration: none;
      font-size: 1rem;
      transition: color 0.3s ease;
    }

    nav ul li a:hover {
      color: #c0ffb3;
    }

    .dropdown {
      display: none;
      position: absolute;
      top: 100%;
      left: 0;
      background-color: rgba(0, 100, 0, 0.95);
      padding: 0.5rem;
      border-radius: 5px;
      z-index: 999;
    }

    .dropdown a {
      display: block;
      padding: 0.5rem 1rem;
      color: white;
      white-space: nowrap;
    }

    .dropdown a:hover {
      background-color: #4CAF50;
    }

    nav ul li:hover .dropdown {
      display: block;
      
      
    }

    section {
      min-height: 100vh;
      padding: 6rem 2rem 2rem 2rem;
      background-size: cover;
      background-position: center;
      color: white;
    }

    #home {
      background-image: url('https://images.unsplash.com/photo-1563201515-adbe35c669c5?q=80&w=1174&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');
      
      justify-content: center;
      align-items: center;
      font-size: 3.5rem;
      color: #65b0c7;
      
      
      text-align: center;
    }

    #products {
      background-image: url('https://images.unsplash.com/photo-1749991060501-b404f90f9af5?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
    }

    .product {
      display: none;
      margin: 2rem auto;
      padding: 1.5rem;
      background-color: rgb(23, 170, 196);
      border-radius: 15px;
      max-width: 800px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.4);
      text-align: center;
      transition: transform 0.3s ease, background-color 0.3s ease;
      color: #121213;
    }

    .product.active {
      display: block;
    }

    .product img {
      width: 100%;
      max-width: 300px;
      border-radius: 10px;
      margin-bottom: 1rem;
    }

    #about {
      background-image: url('https://images.unsplash.com/photo-1691360409875-6794fcda7830?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');
      justify-content: center;
      color: #121213;
    }

    #contact {
      background-image: url('https://images.unsplash.com/photo-1626808642875-0aa545482dfb?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');
      display: flex;
      justify-content: center;
      align-items: center;
      text-align: center;
      flex-direction: column;
    }

    .contact-info, form {
      background-color: rgba(15, 15, 15, 0.9);
      padding: 2rem;
      border-radius: 15px;
      max-width: 500px;
      margin: 1rem auto;
      box-shadow: 0 4px 12px rgba(245, 244, 244, 0.4);
    }

    .contact-info p {
      margin: 1rem 0;
      font-size: 1.1rem;
    }

    footer {
      background: linear-gradient(to right, #5b21b6, #4338ca);
      color: white;
      padding: 1.5rem;
      text-align: center;
    }

    footer a {
      color: #fff;
      margin: 0 0.5rem;
      transition: color 0.3s ease;
    }

    footer a:hover {
      color: #facc15;
    }

    @media (max-width: 768px) {
      nav ul {
        flex-direction: column;
        background-color: rgba(0, 100, 0, 0.9);
        position: absolute;
        top: 60px;
        left: -100%;
        width: 100%;
        transition: all 0.3s ease;
      }

      nav ul.active {
        left: 0;
      }

      .menu-toggle {
        display: block;
        cursor: pointer;
        font-size: 1.5rem;
        color: rgb(10, 9, 9);
      }
    }

    .menu-toggle {
      display: none;
    }
  </style>
</head>
<body>
  <nav>
    <div class="logo">Organic Farming</div>
    <div class="menu-toggle" onclick="toggleMenu()">☰</div>
    <ul id="nav-links">
      <li><a href="#home">Home</a></li>
      <li>
        <a href="#products">Products</a>
        <div class="dropdown">
          <a href="#" onclick="showProduct('tomato', event)">Tomato</a>
          <a href="#" onclick="showProduct('carrot', event)">Carrot</a>
          <a href="#" onclick="showProduct('spinach', event)">Spinach</a>
          <a href="#" onclick="showProduct('broccoli', event)">Broccoli</a>
          <a href="#" onclick="showProduct('sweet potato', event)">Sweet potato</a>
          <a href="#" onclick="showProduct('peas', event)">peas</a>
          <a href="#" onclick="showProduct('kale', event)">kale</a>
          <a href="#" onclick="showProduct('red cabbage', event)">Red cabbage</a>
          <a href="#" onclick="showProduct('radish', event)">Radish</a>
          <a href="#" onclick="showProduct('celery', event)">Celery</a>
        </div>
      </li>
      <li><a href="#about">About</a></li>
      <li><a href="#contact">Contact</a></li>
      <a href="logout.php" class="logout-btn">Logout</a>

    </ul>
  </nav>

  <section id="home">
    <h1>Welcome to Organic Farming</h1>
    <p>Natural, Healthy and Sustainable Agriculture</p>
  </section>

  <section id="products">
    <div id="tomato" class="product">
      <h2>Tomato</h2>
      <img src="https://upload.wikimedia.org/wikipedia/commons/8/89/Tomato_je.jpg" alt="Tomato">
      <p><strong>How to Grow:</strong> Use well-drained soil, water regularly, full sun exposure.</p>
      <p><strong>Health Benefits:</strong> Rich in Vitamin C, improves skin, fights cancer.</p>
      <p><strong>Pest Control:</strong> Use neem oil or companion plants like basil.</p>
    </div>
    <div id="carrot" class="product">
      <h2>Carrot</h2>
      <img src="https://plus.unsplash.com/premium_photo-1664277022334-de9ab23c0ee2?q=80&w=1147&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Carrot">
      <p><strong>How to Grow:</strong> Sandy soil, plenty of sunlight, thin seedlings for space.</p>
      <p><strong>Health Benefits:</strong> Improves eyesight, boosts immunity, supports digestion.</p>
      <p><strong>Pest Control:</strong> Avoid carrot fly using fine mesh covers or intercropping.</p>
    </div>
    <div id="spinach" class="product">
      <h2>Spinach</h2>
      <img src="https://plus.unsplash.com/premium_photo-1701903975329-251de70a5e35?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Spinach">
      <p><strong>How to Grow:</strong> Moist soil, partial shade, sow seeds directly.</p>
      <p><strong>Health Benefits:</strong> High in iron, good for bones and eyes.</p>
      <p><strong>Pest Control:</strong> Use garlic spray or floating row covers.</p>
    </div>
    
    <div id="broccoli" class="product">
      <h2>Broccoli</h2>
      <img src="https://plus.unsplash.com/premium_photo-1702082810649-74097fd3587a?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Broccoli">
      <p><strong>How to grow:Plant in cool weather with full sun and fertile soil.</strong></p>
      <p><strong>Health Benefits:Boosts immunity and bone health with vitamins C & K.</strong></p>
      <p><strong>Pest control: Use neem oil to repel cabbage worms and aphids.</strong></p>

    </div>
    <div id="sweet potato" class="product">
      <h2>Sweet potato</h2>
      <img src="https://images.unsplash.com/photo-1680472628312-9ff2605ee718?q=80&w=765&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Sweet potato">
      <p><strong>How to grow:Plant slips in warm, sunny, well-drained soil.</strong></p>
      <p><strong>Health Benefits:Regulates blood sugar and aids vision.</strong></p>
      <p><strong>Pest control: Rotate crops and use neem spray</strong></p>

    </div>
    <div id="peas" class="product">
      <h2>Peas</h2>
      <img src="https://images.unsplash.com/photo-1651793440182-090126813ac0?q=80&w=1074&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Peas">
      <p><strong>How to grow:Plant in cool weather with support for climbing.</strong></p>
      <p><strong>Health Benefits:Rich in protein, fiber, and vitamin K.</strong></p>
      <p><strong>Pest control: Use neem oil and row covers to deter aphids.</strong></p>

    </div>
    <div id="kale" class="product">
      <h2>Kale</h2>
      <img src="https://plus.unsplash.com/premium_photo-1675011288480-abee1adc561d?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Kale">
      <p><strong>How to grow:Sow in spring/fall in full sun or partial shade.</strong></p>
      <p><strong>Health Benefits: Packed with antioxidants and vitamin C.</strong></p>
      <p><strong>Pest control: Handpick cabbage worms and use neem spray.</strong></p>

    </div>
    <div id="red cabbage" class="product">
      <h2>Red cabbage</h2>
      <img src="https://plus.unsplash.com/premium_photo-1692649061875-204fef9acb58?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Red cabbage">
      <p><strong>How to grow:Plant in well-drained, fertile soil in cool weather.</strong></p>
      <p><strong>Health Benefits:Boosts brain and heart health with anthocyanins.</strong></p>
      <p><strong>Pest control: Protect from caterpillars with row covers.</strong></p>

    </div>
    <div id="radish" class="product">
      <h2>Radish</h2>
      <img src="https://images.unsplash.com/photo-1701960978767-ae393bb80f04?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Radish">
      <p><strong>How to grow:Sow seeds directly in cool weather; fast-growing.</strong></p>
      <p><strong>Health Benefits:Aids digestion and detoxification.</strong></p>
      <p><strong>Pest control: Use floating covers to prevent root maggots.</strong></p>

    </div>
    <div id="celery" class="product">
      <h2>Celery</h2>
      <img src="https://images.unsplash.com/photo-1605207582241-f131f9710bfe?q=80&w=667&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Celery">
      <p><strong>How to grow:Start indoors and transplant into rich, moist soil.</strong></p>
      <p><strong>Health Benefits: Supports hydration and reduces inflammation.</strong></p>
      <p><strong>Pest control:  Control aphids with insecticidal soap or neem oil.</strong></p>

    </div>
    

  </section>

  <section id="about">
    <h2>Organic Agriculture</h2>
    <p>
      <strong>✅ What is Organic Agriculture?</strong><br/>
      Organic agriculture is a holistic and sustainable farming approach that emphasizes working in harmony with nature to produce food, fiber, and other agricultural products. It avoids the use of synthetic fertilizers, chemical pesticides, genetically modified organisms (GMOs), antibiotics, and growth hormones, instead relying on natural processes and eco-friendly methods such as composting, crop rotation, green manures, biological pest control, and the use of organic seeds. The primary goal of organic agriculture is to maintain and improve soil fertility, protect water resources, support biodiversity, and promote ecological balance while ensuring the health and well-being of both farmers and consumers. It encourages the use of renewable resources, recycling of organic waste, and humane treatment of animals. Organic agriculture not only provides safer, chemical-free produce but also contributes to the long-term sustainability of the environment by reducing pollution, conserving energy, and mitigating the effects of climate change. As awareness about environmental issues and health concerns grows, organic agriculture is increasingly being recognized as a viable and necessary alternative to conventional farming.
    </p>
    <p>
      <strong>🌱 What is Organic Farming?</strong><br/>
      Organic farming is a sustainable agricultural method that involves growing crops and raising livestock using natural processes, without the use of synthetic fertilizers, chemical pesticides, genetically modified organisms (GMOs), or artificial growth hormones. It emphasizes the health of the soil, plants, animals, and the environment by using techniques like composting, crop rotation, green manures, and biological pest control. Organic farming aims to maintain ecological balance, conserve biodiversity, and produce food that is safe, nutritious, and free from harmful residues. By avoiding toxic chemicals and promoting natural growth, it not only ensures better health for consumers but also protects the environment by reducing pollution, improving soil fertility, and supporting pollinators and beneficial organisms. This method promotes long-term sustainability and is increasingly being adopted by farmers and households for its environmental and health benefits.
    </p>
    <p>
      <strong>🌟 Importance of Organic Farming:</strong><br/>
      <strong>*Healthier food</strong> : No harmful pesticides or chemicals.<br/>
      <strong>*Environmental protection</strong> : Prevents soil, water, and air pollution.<br/>
      <strong>*Better soil health</strong> :Enhances fertility and biodiversity.<br/>
      <strong>*Sustainable</strong> : Preserves resources for future generations.<br/>
      <strong>*Supports pollinators</strong> : Avoids toxic sprays harmful to bees and butterflies.<br/>
    </p>
    <p>
      <strong>🏡 How to Do Organic Farming at Home (Even in Small Spaces):</strong><br/>
      <strong>1.Choose a Location:</strong><br/>
      *Use a terrace, balcony, backyard, or even window sills with pots.<br>
      <strong>2.Select Crops:</strong><br>
      *Start with easy vegetables like tomato, spinach, coriander, radish, mint, or chili.<br>
      <strong>3.Use Organic Soil:</strong><br>
      *Mix garden soil with compost or vermicompost (can be homemade).<br>
      <strong>4.Natural Fertilizers:</strong><br>
      *Use kitchen waste compost, cow dung, banana peel tea, or neem cake.<br>
      <strong>5. Pest Control:</strong><br>
      *Spray diluted neem oil, garlic-chili spray, or plant marigold nearby.<br>
      <strong>6. Watering:</strong><br>
      *Water regularly but avoid overwatering. Morning watering is best.<br>
      <strong>7. Crop Rotation and Companion Planting:</strong><br>
      *Change crops seasonally and plant pest-repelling herbs like basil or mint.


    </p>
    
  </section>

  <section id="contact">
  <h2>Contact Me</h2>
  <form action="https://formspree.io/f/xkgzrynr" method="POST">
    <input type="text" name="name" placeholder="Your Name" required><br>
    <input type="email" name="email" placeholder="Your Email" required><br>
    <textarea name="message" rows="5" placeholder="Your Message" required></textarea><br>
    <button type="submit">Send Message</button>
  </form>
</section>

  <footer>
    <p>© 2025 Trisha Dutta. All rights reserved.</p>
    <div class="mt-3 space-x-4">
      <a href="https://www.linkedin.com/in/trisha-dutta-a24768284" target="_blank">LinkedIn</a>
      <a href="mailto:trishad257@gmail.com">Email</a>
    </div>
  </footer>

  <script>
    function toggleMenu() {
      document.getElementById('nav-links').classList.toggle('active');
    }

    function showProduct(id, event) {
      if (event) event.preventDefault();

      const products = document.querySelectorAll('.product');
      products.forEach(p => p.classList.remove('active'));

      const selected = document.getElementById(id);
      if (selected) {
        selected.classList.add('active');
        document.getElementById('products').scrollIntoView({ behavior: 'smooth' });
      }
    }
  </script>
</body>
</html>