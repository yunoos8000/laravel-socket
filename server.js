const express = require("express");
const app = express();
const http = require("http");
const server = http.createServer(app);

const io = require("socket.io")(server, {
    cors: { origin: "*" },
});

io.on("connection", (socket) => {
    console.log("a user connected");

    socket.on("sendMessageToServer", (message) => {
        console.log(message);
        io.sockets.emit("sendMessageToClient", message);
    });

    socket.on("disconnect", () => {
        console.log("user disconnected");
    });
});

app.get("/", (req, res) => {
    io.sockets.emit("sendMessageToClient", "a user connected1");
    res.send("Hello World!");
});

server.listen(3000, () => {
    console.log("listening on *:3000");
});
