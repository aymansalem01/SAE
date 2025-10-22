<div class="chatSection">
            <!-- Welcome Section -->
            <div class="welcome">
                <div class="cycle">
                    <img src={{ asset('assets\image.png') }} alt="Bot Logo" width="80" height="80" />
                </div>
                <h2 style="color: white">Welcome to Mr.X AI</h2>
                <h4 style="color: #88888a; max-width: 450px">
                    I'm here to help you with any questions or tasks. Start a
                    conversation by typing a message below.
                </h4>
            </div>

            <!-- Messages -->
            <div class="chatMessages" id="showMessage">
            </div>
            <div class="" style="height: 70px;" id="loader">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" width="200" height="50">
                    <circle fill="#ffdd00" stroke="#50FFB4" stroke-width="5" r="25" cx="240" cy="70">
                        <animate attributeName="opacity" calcMode="spline" dur="2s" values="1;0;1;"
                            keySplines=".5 0 .5 1;.5 0 .5 1" repeatCount="indefinite" begin="-.4s"></animate>
                    </circle>
                    <circle fill="#ffdd00" stroke="#50FFB4" stroke-width="5" r="25" cx="320" cy="70">
                        <animate attributeName="opacity" calcMode="spline" dur="2s" values="1;0;1;"
                            keySplines=".5 0 .5 1;.5 0 .5 1" repeatCount="indefinite" begin="-.2s"></animate>
                    </circle>
                    <circle fill="#ffdd00" stroke="#50FFB4" stroke-width="5" r="25" cx="400" cy="70">
                        <animate attributeName="opacity" calcMode="spline" dur="2s" values="1;0;1;"
                            keySplines=".5 0 .5 1;.5 0 .5 1" repeatCount="indefinite" begin="0s"></animate>
                    </circle>
                </svg>
            </div>

            <!-- Input Section -->
            <div class="inputSection">
                <input type="text" placeholder="How can I help you today?" id="userInput" wire:model="message"
                    style="background-color: #101010" />
                <select wire:model="type" name="type" id="type" required class=" text-white fs-5"
                    style="background-color: #101010">
                    <option value="text" selected>Talk to Mr.X</option>
                    <option value="image">image generate</option>
                </select>
                <button type="button" class="sendBtn" id="sendChat" wire:click="sendMessage" >➤</button>
            </div>
</div>
