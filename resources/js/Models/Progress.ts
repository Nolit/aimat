export default class Progress {
    constructor(
        public id: number|undefined,
        public routine_id: number,
        public value: number = 0,
    ) {

    }
}
