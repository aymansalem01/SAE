
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SEA Chatbot</title>
    <link rel="stylesheet" href={{ asset('assets\style.css') }} />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


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
        @livewire('chat-bot')
    </div>
    <button type="button" data-bs-toggle="modal" data-bs-target="#formModal" style="display: none"
        id="openModal"></button>

    {{-- <script type="module">


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

    </script> --}}
</body>

</html>
