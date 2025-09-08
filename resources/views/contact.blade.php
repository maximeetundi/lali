    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">
  
          <div class="section-header">
            <h2>Contact</h2>
            <p><?= gen_text($texts, 'description_contact') ?></p>
          </div>
  
          <div class="row gx-lg-0 gy-4">
  
            <div class="col-lg-4">
  
              <div class="info-container d-flex flex-column align-items-center justify-content-center">
                <div class="info-item d-flex">
                  <i class="bi bi-geo-alt flex-shrink-0"></i>
                  <div>
                    <h4>Addresse:</h4>
                    <p>Yaounde, Cameroun</p>
                  </div>
                </div><!-- End Info Item -->
  
                <div class="info-item d-flex">
                  <i class="bi bi-envelope flex-shrink-0"></i>
                  <div>
                    <h4>Email:</h4>
                    <p>contact@societelali.com</p>
                  </div>
                </div><!-- End Info Item -->
  
                <div class="info-item d-flex">
                  <i class="bi bi-phone flex-shrink-0"></i>
                  <div>
                    <h4>Telephone:</h4>
                    <p>+237 678 805 224</p>
                  </div>
                </div><!-- End Info Item -->
  
          
              </div>
  
            </div>
  
            <div class="col-lg-8">
              <form action=""  role="form" class="php-email-form">
                <div class="row">
                  <div class="col-md-6 form-group">
                    <input type="text" name="name" class="form-control" id="name" placeholder="Nom" required>
                  </div>
                  <div class="col-md-6 form-group mt-3 mt-md-0">
                    <input type="text" class="form-control" name="email" id="email" placeholder="Telephone/Email" required>
                  </div>
                </div>
                <div class="form-group mt-3">
                  <input type="text" class="form-control" name="subject" id="subject" placeholder="Sujet" required>
                </div>
                <div class="form-group mt-3">
                  <textarea class="form-control" name="message" rows="7" placeholder="Message" required></textarea>
                </div>
                <div class="my-3">
                  <div class="loading">Chargement</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Your message has been sent. Thank you!</div>
                </div>
                <div class="text-center"><button type="submit" style="background: #f85a40" name="wa">Envoyer Par <i class="bi bi-whatsapp"></i></button> <button type="submit" name="em">Envoyer Par <i class="bi bi-envelope"></i></button></div>
               
              </form>
            </div><!-- End Contact Form -->

            <script>

              const messageInput = document.querySelector('textarea[name="message"]');
              const whatsappButton = document.querySelector('button[name="wa"]');
              const emailButton = document.querySelector('button[name="em"]');
              
                    whatsappButton.addEventListener('click', () => {
                     
                const message = messageInput.value;
                const phone = '237678805224'; // Replace with your phone number
                const url = `whatsapp://send?text=${message}&phone=${phone}`;
                window.location.href = url;
              });
              
              emailButton.addEventListener('click', () => {
               
                const message = messageInput.value;
                const subject = document.querySelector('input[name="subject"]').value;
                const email = document.querySelector('input[name="email"]').value;
                const url = `mailto:contact@societelali.com?body=${encodeURIComponent(message)}&from=${encodeURIComponent(email)}`;
                window.open(url, '_blank');
              });
                  </script>
  
          </div>
  
        </div>
      </section><!-- End Contact Section -->