export default class Target {
    constructor(private target1: string, private target2?: string) {
    }
    toString() {
        return this.target1 + (this.target2 ? '~' + this.target2 : '')
    }
}
