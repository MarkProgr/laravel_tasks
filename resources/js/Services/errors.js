export default class ValidationError extends Error {
    constructor(messages)
    {
        super();
        this.messages = messages;
    }

    getMessages()
    {
        return this.messages;
    }
}
