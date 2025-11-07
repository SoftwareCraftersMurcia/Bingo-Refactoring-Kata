class Cell {
  public readonly value: string | null;
  public marked: boolean;
  constructor (value: string | null, marked: boolean){
    this.value = value
    this.marked = marked
  }
}

export class BingoBoard {
  private readonly theCells: Cell[][];
  private readonly cells: (string | null)[][];
  private readonly marked: boolean[][];

  constructor(width: number, height: number) {
    this.cells = Array.from({ length: width }, () =>
      Array.from({ length: height }, () => null)
    );
    this.marked = Array.from({ length: width }, () =>
      Array.from({ length: height }, () => false)
  );
    this.theCells = Array.from({ length: width }, () =>
      Array.from({ length: height }, () => new Cell(null, false))
    );
  }

  defineCell(x: number, y: number, value: string): void {
    if (this.cells[x][y] !== null) {
      throw new Error("cell already defined");
    }

    for (let c = 0; c < this.cells.length; c++) {
      for (let r = 0; r < this.cells[c].length; r++) {
        if (value === this.cells[c][r]) {
          throw new Error(`${value} already present at ${c},${r}`);
        }
      }
    }

    this.cells[x][y] = value;
    this.theCells[x][y] = new Cell(value, false);
  }

  markCell(x: number, y: number): void {
    if (!this.isInitialized()) {
      throw new Error("board not initialized");
    }
    this.marked[x][y] = true;
    this.theCells[x][y].marked = true;
  }

  isMarked(x: number, y: number): boolean {
    return this.marked[x][y];
  }

  isInitialized(): boolean {
    for (const row of this.cells) {
      for (const col of row) {
        if (col === null) {
          return false;
        }
      }
    }
    return true;
  }
}
