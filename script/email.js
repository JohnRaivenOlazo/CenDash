import emailjs from 'emailjs-com';
emailjs.init("JJP4XUwcSe2OyYQpT");
const recipientEmails = ["johnraivenolazo@gmail.com", "jrraiven15@gmail.com"];

const serviceIDs = {
    "johnraivenolazo@gmail.com": "service_eixtpe8",
    "jrraiven15@gmail.com": "service_lyjfrfk"
    // Add more recipients and service IDs
    // eg. "name@gmail.com": "service_id",
};

const templateID = "template_607131g"; 

document.getElementById('sendEmailButton').addEventListener('click', async function () {
    for (const recipient of recipientEmails) {
        const serviceID = serviceIDs[recipient];
        if (!serviceID) {
            console.error(`Service ID not found for recipient: ${recipient}`);
            continue;
        }
        const templateParams = {
            to_email: recipient,
            from_name: "CenDash | Landing Page",
            user_name: document.getElementById('name').value,
            user_email: document.getElementById('email').value,
            message: document.getElementById('message').value
        };

        try {
            const response = await emailjs.send(serviceID, templateID, templateParams);
            console.log("Email sent successfully to", recipient, ":", response);
        } catch (error) {
            console.log("Email failed to send to", recipient, ":", error);
        }
    }

    alert("🌟 Hooray! Your messages have been sent successfully!");
});
