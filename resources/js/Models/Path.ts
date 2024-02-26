import Routine from "@/Models/Routine";
import {Task} from "@/types";

export default class Path {
    constructor(public id: number, public name: string, public note: string = '', public routines: Array<Routine>, public tasks:Array<Task>) {
    }
}
