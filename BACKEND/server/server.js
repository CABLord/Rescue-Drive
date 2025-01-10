const express = require("express");

const server = express();// ertellen von Server Objekt
server.use(express.json());

let data = [
    {
        id: 1,
        name: "test1"
    },
    {
        id: 2,
        name: "test2"
    }
]

server.post("/users", (req, res) => {
    const newuser = {
        id: req.body.id,
        name: req.body.name
    }
    data.push(newuser);
    res.status(201).json(newuser);
});

server.get("/users", (req, res) => {
    res.json(data);
});
server.get("/users/:id", (req, res) => {
    const userid = parseInt(req.params.id);
    const user = data.find(u => u.id === userid);
    if (!user) {
        res.send("User not found!");
        return;
    }
    res.json(user);


});

server.listen(3000, () => {
    console.log("My server is listening");
})