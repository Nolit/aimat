import Progress from "@/Models/Progress";

export default class Routine {
    constructor(
        public id: number|undefined,
        public path_id: number,
        public name: string = '',
        public type: number|undefined = undefined,
        public amount: number|undefined = undefined,
        public unit: string = '',
        public note: string = '',
        public today_progress: Progress|undefined = undefined
    ) {

    }
}
