    <!-- -- footer --  -->
    <footer class="section-padding">
      <div class="main-footer max-theme-width">
        <div class="row">
          <div class="col-lg-3 col-md-6 mb-4 col-12">
            <div class="f-logo">
              <img src="{{asset('public/frontend/assets/img/footer/footer-logo.png')}}" alt="" />
            </div>
            <p class="p-1">
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam
              est alias quia dolorem molestias ducimus?
            </p>
          </div>
          <div class="col-12 col-lg-3 col-md-6 mb-4 footer-links">
            <div class="f-c-list">
              <div class="f-list-item">
                <img src="./assets/img/footer/arrow.png" alt="" />
                <a href="#">About</a>
              </div>
              <div class="f-list-item">
                <img src="./assets/img/footer/arrow.png" alt="" />
                <a href="#">Services</a>
              </div>
              <div class="f-list-item">
                <img src="./assets/img/footer/arrow.png" alt="" />
                <a href="#">Why SPADEKARD</a>
              </div>
              <div class="f-list-item">
                <img src="./assets/img/footer/arrow.png" alt="" />
                <a href="#">Compare Now</a>
              </div>
            </div>
          </div>

          @php
          $contact = DB::table('contact')->where('id',1)->first();
          @endphp


          <div class="col-lg-3 col-md-6 mb-4 col-12 my-3">
            <table>
              <tbody>
                <tr>
                  <td>
                    <img src="./assets/img/footer/map.png" alt="" />
                  </td>
                  <td>{{@$contact->address}}</td>
                </tr>
                <tr>
                  <td>
                    <img src="./assets/img/footer/email.png" alt="" />
                  </td>
                  <td>
                    <a href="mailto:$contact->email">{{$contact->email}}</a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="col-lg-3 col-md-6 mb-4 col-12 my-3">
            <div class="f-social">
              <a href="https://twitter.com/"><i class="fab fa-twitter"></i></a>
              <a href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a>
              <a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
              <a href="https://www.youtube.com/"><i class="fab fa-youtube"></i></a>
            </div>
            <div class="f-social-btn">
              <button class="btn btn-outline-warning btn-sm">share now</button>
            </div>
          </div>
        </div>
        <div class="dropdown-divider"></div>
        <div class="f-last">
          <div>
            <p class="p-last">copyright Ⓒ 2022 Spadekard- all right reserved</p>
          </div>
          <div>
            <a class="f-a-last" href="https://www.google.com/">T&C</a>
            <span class="f-s-last">|</span>
            <a class="f-a-last" href="https://www.google.com/">PRIVACY AND POLICY</a>
          </div>
        </div>
      </div>
    </footer>