<?php
/**
 * Class Course
 *
 * Data Transfer Object for the Courses Table
 */
class Course {
    private ?string $courseID = null;
    private ?string $title = null;
    private ?string $description = null;
    private ?string $date = null;
    private ?string $startTime = null;
    private ?string $endTime = null;
    
    /**
     * @return string|null
     */
    public function getCourseID(): ?string {
        return $this->courseID;
    }
    
    /**
     * @param string|null $courseID
     */
    public function setCourseID(?string $courseID): void {
        $this->courseID = $courseID;
    }
    
    /**
     * @return string|null
     */
    public function getTitle(): ?string {
        return $this->title;
    }
    
    /**
     * @param string|null $title
     */
    public function setTitle(?string $title): void {
        $this->title = $title;
    }
    
    /**
     * @return string|null
     */
    public function getDescription(): ?string {
        return $this->description;
    }
    
    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void {
        $this->description = $description;
    }
    
    /**
     * @return string|null
     */
    public function getDate(): ?string {
        return $this->date;
    }
    
    /**
     * @param string|null $date
     */
    public function setDate(?string $date): void {
        $this->date = $date;
    }
    
    /**
     * @return string|null
     */
    public function getStartTime(): ?string {
        return $this->startTime;
    }
    
    /**
     * @param string|null $startTime
     */
    public function setStartTime(?string $startTime): void {
        $this->startTime = $startTime;
    }
    
    /**
     * @return string|null
     */
    public function getEndTime(): ?string {
        return $this->endTime;
    }
    
    /**
     * @param string|null $endTime
     */
    public function setEndTime(?string $endTime): void {
        $this->endTime = $endTime;
    }
    
    
}
