import Routine from "@/Models/Routine";

export default class Path {
    constructor(public id: number, public name: string, public note: string = '', public routines: Array<Routine>) {
    }
}
