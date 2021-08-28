<x-Layout>
    
    <x-slot name="title">Edit Contact Me</x-slot>
    <x-slot name="page_css"></x-slot>

    <h1 class="title">Contact Me</h1>
    <hr>
    <p class="content">
        <!-- Validation Errors --> 
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if ( Session::get("success") )
            <p class="alert alert-success">{{ Session::get("success") }}</p>
        @endif

        <form action="{{ route('store_contactMe') }}" method="POST">
            @csrf

            <!-- Email form-group -->
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="emailCheckBox">
                    <label class="form-check-label" for="emailCheckBox">
                      Email Account Address
                    </label>
                  </div>
                <input name="email" value="{{ $values['email'] }}" type="text" class="form-control" id="emailText" placeholder="Email Address" required />

                <script>
                    document.getElementById('emailText').disabled = true;
                    document.getElementById('emailCheckBox').onchange = function() {
                        document.getElementById('emailText').disabled = !this.checked;
                    };
                </script>
            </div>

            <!-- LinkedIn form-group -->
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="linkedinCheckBox">
                    <label class="form-check-label" for="linkedinCheckBox">
                      LinkedIn Account Address
                    </label>
                  </div>
                <input name="linkedin" value="{{ $values['linkedin'] }}" type="text" class="form-control" id="linkedinText" placeholder="Linkedin Address" required />

                <script>
                    document.getElementById('linkedinText').disabled = true;
                    document.getElementById('linkedinCheckBox').onchange = function() {
                        document.getElementById('linkedinText').disabled = !this.checked;
                    };
                </script>
            </div>

            <!-- Twitter form-group -->
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="twitterCheckBox">
                    <label class="form-check-label" for="twitterCheckBox">
                      Twitter Account Address
                    </label>
                  </div>
                <input name="twitter" value="{{ $values['twitter'] }}" type="text" class="form-control" id="twitterText" placeholder="Twitter Address" required />

                <script>
                    document.getElementById('twitterText').disabled = true;
                    document.getElementById('twitterCheckBox').onchange = function() {
                        document.getElementById('twitterText').disabled = !this.checked;
                    };
                </script>
            </div>

            <!-- Instagram form-group -->
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="instaCheckBox">
                    <label class="form-check-label" for="instaCheckBox">
                      Instagram Account Address
                    </label>
                  </div>
                <input name="instagram" value="{{ $values['instagram'] }}" type="text" class="form-control" id="instaText" placeholder="Instagram Address" required />

                <script> 
                    document.getElementById('instaText').disabled = true;
                    document.getElementById('instaCheckBox').onchange = function() {
                        document.getElementById('instaText').disabled = !this.checked;
                    };
                </script>
            </div>

            <!-- Github form-group -->
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="githubCheckBox">
                    <label class="form-check-label" for="githubCheckBox">
                      GitHub Account Address
                    </label>
                  </div>
                <input name="github" value="{{ $values['github'] }}" type="text" class="form-control" id="githubText" placeholder="Github Address" required />

                <script>
                    document.getElementById('githubText').disabled = true;
                    document.getElementById('githubCheckBox').onchange = function() {
                        document.getElementById('githubText').disabled = !this.checked;
                    };
                </script>
            </div>

            <!-- Telegram form-group -->
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="telegramCheckBox">
                    <label class="form-check-label" for="telegramCheckBox">
                      Telegram Account Address
                    </label>
                  </div>
                <input name="telegram" value="{{ $values['telegram'] }}" type="text" class="form-control" id="telegramText" placeholder="Telegram Address" required />

                <script>
                    document.getElementById('telegramText').disabled = true;
                    document.getElementById('telegramCheckBox').onchange = function() {
                        document.getElementById('telegramText').disabled = !this.checked;
                    };
                </script>
            </div>

            <button name="submit" class="btn btn-success">save</button>
        </form>
    </p>

</x-Layout>    