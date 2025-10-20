<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SEA Chatbot</title>
    <link rel="stylesheet" href={{ asset('assets\style.css') }} />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script type="importmap">
      {
        "imports": {
          "openai": "https://esm.run/openai"
        }
      }
    </script>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }

        .background {
            background-color: #242424;
        }

        nav img {
            max-width: 200px;
            height: auto;
        }

        .aside {
            display: flex;
            flex-direction: column;
            align-items: center;
            /* min-height: 95vh; */
            height: auto;
            width: 20%;
            background-color: #242424;
            padding-top: 25px;
        }

        .button {
            background-color: #e5c80d;
            color: black;
            border-radius: 50px;
            padding: 15px 35px;
            font-size: 16px;
            font-weight: 600;
            text-align: center;
            border: none;
            transition: transform 0.2s ease-in-out;
        }

        .button:hover {
            transform: scale(1.05);
        }

        .chatSection {
            background-color: rgb(51, 51, 51);
            width: 80%;
            height: 93.8vh;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            align-content: center
        }

        .welcome {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            text-align: center;
            gap: 20px;
            padding: 40px 20px;
        }

        .cycle {
            border-radius: 50%;
            background-color: #e5c80d;
            width: 120px;
            height: 120px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .chatMessages {
            flex: 1;
            overflow-y: auto;
            scroll-behavior: smooth padding: 20px;
            display: none;
            flex-direction: column;
            align-content: end;
            width: 85%;
            justify-items: center;

        }

        .chatMessages::-webkit-scrollbar {
            display: none;
        }

        .message {
            max-width: 65%;
            padding: 12px 16px;
            border-radius: 12px;
            margin-bottom: 15px;
            line-height: 1.5;
            color: rgb(230, 230, 230);
            word-wrap: break-word;
            animation: fadeIn 0.2s ease-in;
        }

        .ai {
            background-color: #444654;
            border-top-left-radius: 0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            margin-right: auto;
            margin-left: 200px;
            white-space: pre-line;
        }

        .image {
            background-color: #444654;
            border-top-left-radius: 0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            margin-right: auto;
            margin-left: 200px;
            white-space: pre-line;
        }

        .image img {
            max-width: 300px;
            border-radius: 12px;
        }

        .user {
            background-color: rgb(180, 142, 36);
            margin-left: auto;
            border-top-right-radius: 0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .inputSection {
            border-top: 1px solid #565869;
            padding: 15px 20px;
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .inputSection input {
            flex: 1;
            border-radius: 20px;
            padding: 14px;
            font-size: 16px;
            background-color: #1a1a1a;
            color: white;
            border: none;
            outline: none;
        }

        .sendBtn {
            background-color: #e5c80d;
            padding: 14px 18px;
            font-size: 18px;
            border: none;
            border-radius: 50%;
            transition: transform 0.2s ease-in-out;
        }

        .sendBtn:hover {
            transform: scale(1.1);
        }

        @media screen and (max-width: 1440px) {
            .chatSection {
                height: 90vh;
            }

            .ai {
                margin-left: 150px;
            }
        }

        .clrButton {
            background-color: #808080;
            margin-top: 40px;
            font-size: 18px;
            border: none;
            border-radius: 50px;
            padding: 15px 35px;
            transition: transform 0.2s ease-in-out;
            color: white;
        }

        .clrButton:hover {
            transform: scale(1.1);
        }

        .modalbtn {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #808080;
            color: #fff;
            border: none;
            border-radius: 50px;
            cursor: pointer;
        }

        .saveBtn {
            background-color: #ffdd00;
            color: black;
        }

        .mb-4 input::placeholder {
            color: #ffffff;
            font-size: 16px;
        }

        .mb-4 input:focus {
            background-color: #1f2a38;
            color: white;
            font-size: large;
        }

        .mb-4 input {
            background-color: #4f5866;
            border: none;
            padding: 10px;
            color: white;
        }

        .mb-4 select {
            background-color: #4f5866;
            border: none;
            padding: 10px;
            color: white;
        }

        .chatLogo {
            width: 4rem;
            height: 4rem;
            border-radius: 999px;
            background-color: #ffdd00;
            padding: 2px;
            text-align: center;
        }

        #loader {
            display: none;
            margin-left: 100px;
            margin-top: 40px
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="background p-3">
        <img src={{ asset('assets\SAE-Horizontal-White.webp') }} alt="SEA Logo" />
    </nav>

    <div class="d-flex">
        <!-- Sidebar -->
        <aside class="aside">
            <button class="button" id="newChat">+ New Chat</button>
            <button class="clrButton" id="clrChat">clear chat</button>
        </aside>

        <!-- Chat Section -->
        <section class="chatSection">
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
                <input type="text" placeholder="How can I help you today?" id="userInput"
                    style="background-color: #101010" />
                <select name="type" id="type" required class=" text-white fs-5"
                    style="background-color: #101010">
                    <option value="text" selected>Talk to Mr.X</option>
                    <option value="image">image generate</option>
                </select>
                <button type="button" class="sendBtn" id="sendChat">➤</button>
            </div>
        </section>
    </div>
    <button type="button" data-bs-toggle="modal" data-bs-target="#formModal" style="display: none"
        id="openModal"></button>

    <!-- Modal -->
    <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content" style="background-color: #101010;">
                <div class="modal-header">
                    <div class="d-flex gap-3">
                        <div class="chatLogo">
                            <img src={{ asset('assets\image.png') }} alt="" width="90%" />
                        </div>
                        <div>
                            <h1 class="modal-title fs-5 text-white mb-1">
                                AI Study Assistant
                            </h1>
                            <h5 style="color: gray; font-size: 12px">
                                Get help with your studied
                            </h5>
                        </div>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close" id="closeButton"></button>
                </div>
                <div class="modal-body p-4">
                    <form action="">
                        <div class="mb-4 pb-2">
                            <label for="recipient-name" class="col-form-label text-white fs-5 fw-bold">Select DR
                                Name:</label>
                            <select name="drName" id="drName" required class="form-select text-white fs-5">
                                <option>choose a subject ....</option>
                                <option value="sami">DR.Sami</option>
                                <option value="marwan">DR.Marwan</option>
                                <option value="saed">DR.Saed</option>
                                <option value="yousef">DR.Yousef</option>


                            </select>
                        </div>
                        <div class="mb-4 pb-2">
                            <label for="message-text" class="col-form-label text-white fs-5 fw-bold">Student
                                Name:</label>
                            <input id="studentName" type="text" class="form-control"
                                placeholder="Enter your name" />
                        </div>
                        <div class="mb-4 pb-2">
                            <label for="message-text" class="col-form-label text-white fw-bold fs-5">Student
                                Email:</label>
                            <input id="studentEmail" type="email" class="form-control"
                                placeholder="Enter your email" />
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="modalbtn" data-bs-dismiss="modal">Close</button> -->
                    <button type="button" class="modalbtn saveBtn" id="submit">
                        submit
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script type="module">
        import OpenAI from "openai";


        // getting dom elements
        const showMessages = document.getElementById("showMessage");
        const userInput = document.getElementById("userInput");
        const sendChat = document.getElementById("sendChat");
        const welcome = document.querySelector(".welcome");
        const newChatBtn = document.getElementById("newChat");
        const clrButton = document.getElementById("clrChat");
        const openModal = document.getElementById("openModal");
        const closeButton = document.getElementById("closeButton");
        const submit = document.getElementById("submit");
        const inputStudentName = document.getElementById("studentName");
        const inputStudentEmail = document.getElementById("studentEmail");
        let studentName = sessionStorage.getItem("studentName") || "";
        let studentEmail = sessionStorage.getItem("studentEmail") || "";
        const inputDrName = document.getElementById("drName");
        let drName = sessionStorage.getItem("drName") || "";
        let assistant_id = '';
        window.OPENAI_KEY = "{{ config('services.openai.key') }}";
        const loader = document.getElementById("loader");
        let thread = sessionStorage.getItem("thread") || "";
        const type = document.getElementById("type");

        const client = new OpenAI({
            apiKey: OPENAI_KEY,
            dangerouslyAllowBrowser: true,
        });


        // when windows load
        if (studentName == "" && drName == "") {
            openModal.click();
        }
        let chatHistory = JSON.parse(sessionStorage.getItem("chatHistory")) || [];
        if (chatHistory.length > 0) {
            renderMessages();
        }

        // Function to start a new chat
        sendChat.addEventListener("click", startChat);
        document.addEventListener("keydown", (event) => {
            if (event.key == "Enter") {
                // event.preventDefault();
                startChat();
            }
        });
        submit.addEventListener("click", modalForm);


        // render messages from session storage
        function renderMessages() {
            thread = sessionStorage.getItem("thread") || "";
            if (chatHistory.length == 0) {
                showMessages.style.display = "none";
                welcome.style.display = "block";
            } else {
                showMessages.style.display = "block";
                welcome.style.display = "none";
                showMessages.innerHTML = "";

                chatHistory.forEach((msg) => {
                    const msgElement = document.createElement("div");
                    msgElement.classList.add("message", msg.role);

                    if (msg.role === "image") {
                        const imgElement = document.createElement("img");
                        imgElement.src = msg.content;
                        imgElement.alt = "Generated Image";
                        imgElement.style.maxWidth = "300px";
                        imgElement.style.borderRadius = "12px";
                        msgElement.classList.add("image");
                        msgElement.appendChild(imgElement);
                    } else {
                        msgElement.textContent = msg.content;
                    }

                    showMessages.appendChild(msgElement);
                });

                showMessages.scrollTop = showMessages.scrollHeight;
            }
        }

        // receive message from user and send to openai using askOpenAI function
        function startChat() {
            if (userInput.value == "") return;
            if (studentName == "" && studentEmail == "" && drName == "") {
                openModal.click();
                return;
            }

            if (drName == 'sami') {
                assistant_id = 'asst_4K9Q6Wv4jyCuLHiwTJy1Ihat';
            }
            if (drName == 'marwan') {
                assistant_id = 'asst_GyPiRnBa90HeLYml2daSxgyV';
            }
            if (drName == 'saed') {
                assistant_id = 'asst_aQBmqKMwsSo02OwqlUlYARP5';
            }
            if (drName == 'yousef') {
                assistant_id = 'asst_Gk0awJHUaBejHyWRbGGwqO9B';
            }
            showMessages.style.display = "block";
            welcome.style.display = "none";
            const message = userInput.value;
            userInput.value = "";
            const messageElement = document.createElement("div");
            messageElement.classList.add("message", "user");
            messageElement.textContent = message;
            showMessages.appendChild(messageElement);
            loader.style.display = "block";
            chatHistory.push({
                role: "user",
                content: message
            });
            showMessages.scrollTop = showMessages.scrollHeight;
            if (type.value === 'image') {
                generate_image(message);
            } else if (type.value === 'text') {
                askOpenAI(message);
            }
        }
        async function generate_image(message) {
            const response = await client.images.generate({
                model: "dall-e-3",
                prompt: message,
                size: "1024x1024",
                response_format: "url"
            });
            console.log(response);
            const image_url = response.data[0].url;
            const imgElement = document.createElement("img");
            imgElement.src = image_url;
            imgElement.alt = message;
            imgElement.style.maxWidth = "300px";
            imgElement.style.borderRadius = "12px";
            const responseElement = document.createElement("div");
            responseElement.classList.add("message", "image");
            responseElement.appendChild(imgElement);
            showMessages.appendChild(responseElement);
            showMessages.scrollTop = showMessages.scrollHeight;
            chatHistory.push({
                role: "image",
                content: image_url
            });
            loader.style.display = "none";
            saveChat();
        }

        // function to send message to openai and send to show response using showResponseMessage
        async function askOpenAI(message) {
            if (thread == '') {
                const threadResp = await client.beta.threads.create();
                thread = threadResp.id;
                sessionStorage.setItem("thread", thread);
            }
            const threadId = thread;

            await client.beta.threads.messages.create(threadId, {
                role: "user",
                content: message,
            });
            const runResp = await client.beta.threads.runs.create(threadId, {
                assistant_id: assistant_id,
            });
            const runId = runResp.id;
            let run = await client.beta.threads.runs.retrieve(runId, {
                thread_id: threadId,
            });
            do {
                run = await client.beta.threads.runs.retrieve(runId, {
                    thread_id: threadId,
                });
                await new Promise(resolve => setTimeout(resolve, 500));

            } while (run.status == "in_progress")

            const result = await client.beta.threads.messages.list(threadId);
            const aiMessage = result.data.find(m => m.role === "assistant");
            loader.style.display = "none";
            showResponseMessage(aiMessage?.content[0].text.value);
        }

        // receive response and show on screen and going to save chat in session storage using saveChat function
        function showResponseMessage(response) {
            const responseElement = document.createElement("div");
            responseElement.classList.add("message", "ai");
            responseElement.textContent = response.replaceAll("**", '');
            showMessages.appendChild(responseElement);
            showMessages.scrollTop = showMessages.scrollHeight;
            chatHistory.push({
                role: "ai",
                content: response
            });
            saveChat();
        }

        //save pushing chat in session storage
        function saveChat() {
            sessionStorage.setItem("chatHistory", JSON.stringify(chatHistory));
        }

        // newChat btn function to clear chat
        newChatBtn.addEventListener("click", () => {
            chatHistory = [];
            indexFlag = 0;
        });
        // clear chat function
        clrButton.addEventListener("click", () => {
            chatHistory = [];
            sessionStorage.removeItem("chatHistory");
            sessionStorage.removeItem('thread');
            window.location.reload();
            renderMessages();
        });

        //save student info from modal
        function modalForm() {
            if (inputStudentName.value != "" && inputStudentEmail.value != "" && inputDrName.value != "") {
                sessionStorage.setItem("studentName", inputStudentName.value);
                // sessionStorage.setItem("subject", inputSubject.value);
                sessionStorage.setItem("studentEmail", inputStudentEmail.value);
                sessionStorage.setItem("drName", inputDrName.value);
                drName = inputDrName.value;
                studentName = inputStudentName.value;
                studentEmail = inputStudentEmail.value;
                closeButton.click();
            } else {
                alert("Please fill all the fields");
            }
        }
    </script>
</body>

</html>
