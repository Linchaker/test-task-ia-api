<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Actor</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Add Actor</h1>

    <div id="messages" class="mb-4"></div>

    <form id="actorForm" class="space-y-4">
        <div>
            <label class="block mb-1">Email</label>
            <input type="email" name="email" id="email" class="w-full border p-2 rounded">
        </div>
        <div>
            <label class="block mb-1">Description</label>
            <textarea
                name="description"
                id="description"
                placeholder="Please enter your first name and last name, and also provide your address."
                class="w-full border p-2 rounded" rows="4"
            ></textarea>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Add Actor</button>
    </form>
</div>

<script>
    const form = document.getElementById('actorForm');
    const messages = document.getElementById('messages');

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        messages.innerHTML = '';

        const email = document.getElementById('email').value.trim();
        const description = document.getElementById('description').value.trim();

        if (!email || !description) {
            messages.innerHTML = '<div class="bg-red-100 p-2 rounded">Email and Description are required.</div>';
            return;
        }

        try {
            const res = await fetch('/api/v1/actors', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    email,
                    description
                })
            });

            console.log('res', res);
            console.log('res.ok', res.ok);

            if (!res.ok) {
                const data = await res.json();
                let errorHtml = '';
                if (data.errors) {
                    for (const field in data.errors) {
                        errorHtml += `<div>${data.errors[field].join('<br>')}</div>`;
                    }
                } else if (data.message) {
                    errorHtml = `<div>${data.message}</div>`;
                }
                messages.innerHTML = `<div class="bg-red-100 p-2 rounded">${errorHtml}</div>`;
                return;
            }

            window.location.href = '/actors';

        } catch (err) {
            console.error(err);
            messages.innerHTML = '<div class="bg-red-100 p-2 rounded">Something went wrong. Check console.</div>';
        }
    });
</script>
</body>
</html>
